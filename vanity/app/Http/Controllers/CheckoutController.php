<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;


class CheckoutController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to proceed with checkout.');
        }

        $user = Auth::user();
        $addresses = $user->addresses ?? collect();

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $items = [];
        $subtotal = 0;
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product && $quantity > 0) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'total' => $product->price * $quantity,
                ];
                $subtotal += $product->price * $quantity;
            }
        }

        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $shipping = 120.00;
        $tax = $subtotal * 0.12;
        $total = $subtotal + $shipping + $tax;

        $appliedCoupon = null;
        $discount = 0;
        if (Session::has('applied_coupon')) {
            $coupon = Coupon::where('code', Session::get('applied_coupon'))->first();
            if ($coupon && $coupon->isValid()) {
                $appliedCoupon = $coupon;
                $discount = $coupon->calculateDiscount($subtotal);
                $tax = ($subtotal - $discount) * 0.12;
                $total = $subtotal - $discount + $shipping + $tax;
            } else {
                Session::forget('applied_coupon');
            }
        }

        return view('checkout.index', compact('items', 'subtotal', 'shipping', 'tax', 'total', 'addresses', 'appliedCoupon', 'discount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'payment_method' => 'required|in:cash_on_delivery,credit_debit_card,gcash',
        ], [
            'phone.numeric' => 'Invalid contact number.',
            'phone.digits_between' => 'Invalid contact number.',
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $items = [];
        $subtotal = 0;
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product && $quantity > 0) {
                if ($product->stock < $quantity) {
                    return back()->with('error', 'Insufficient stock for ' . $product->name);
                }
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'total' => $product->price * $quantity,
                ];
                $subtotal += $product->price * $quantity;
            }
        }

        $shipping = 120.00;
        $tax = $subtotal * 0.12;
        $total = $subtotal + $shipping + $tax;

        $address = Address::findOrFail($request->address_id);

        try {
            DB::transaction(function () use ($items, $subtotal, $shipping, $tax, $total, $address, $request) {
                $initialStatus = $this->getInitialOrderStatus($request->payment_method);

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'status' => $initialStatus,
                    'subtotal' => $subtotal,
                    'shipping_fee' => $shipping,
                    'tax_amount' => $tax,
                    'discount_amount' => 0,
                    'total' => $total,
                    'shipping_address' => [
                        'label' => $address->label,
                        'line1' => $address->line1,
                        'line2' => $address->line2,
                        'city' => $address->city,
                        'region' => $address->region,
                        'postal_code' => $address->postal_code,
                        'country' => $address->country,
                    ],
                    'transaction_id' => $this->generateTransactionId($request->payment_method),
                ]);

                $paymentSuccess = $this->processPayment($request->payment_method, $total, $order);

                if ($paymentSuccess) {
                    $order->update(['status' => 'paid']);
                } elseif ($request->payment_method !== 'cash_on_delivery') {
                    $order->update(['status' => 'cancelled']);
                    throw new \Exception('Payment processing failed.');
                }

                if ($order->status !== 'cancelled') {
                    foreach ($items as $item) {
                        OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $item['product']->id,
                            'quantity' => $item['quantity'],
                            'unit_price' => $item['product']->price,
                            'line_total' => $item['total'],
                            'brand' => $item['product']->brand,
                        ]);

                        $item['product']->decrement('stock', $item['quantity']);
                    }
                }
            });

            Session::forget('cart');
            return redirect()->route('checkout.success')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $coupon = Coupon::where('code', strtoupper($request->coupon_code))->first();

        if (!$coupon) {
            return response()->json(['error' => 'Invalid coupon code.'], 400);
        }

        if (!$coupon->isValid()) {
            return response()->json(['error' => 'Coupon is expired or has reached maximum redemptions.'], 400);
        }

        $cart = Session::get('cart', []);
        $subtotal = 0;
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product && $quantity > 0) {
                $subtotal += $product->price * $quantity;
            }
        }

        $discount = $coupon->calculateDiscount($subtotal);
        $shipping = 120.00;
        $tax = ($subtotal - $discount) * 0.12;
        $total = $subtotal - $discount + $shipping + $tax;

        Session::put('applied_coupon', $coupon->code);

        return response()->json([
            'success' => true,
            'discount' => $discount,
            'total' => $total,
            'coupon' => $coupon,
        ]);
    }

    public function success()
    {
        return view('checkout.success');
    }

    private function getInitialOrderStatus(string $paymentMethod): string
    {
        return match ($paymentMethod) {
            'cash_on_delivery' => 'pending',
            'credit_debit_card', 'gcash' => 'pending',
            default => 'pending',
        };
    }

    private function generateTransactionId(string $paymentMethod): string
    {
        $prefix = match ($paymentMethod) {
            'cash_on_delivery' => 'COD',
            'credit_debit_card' => 'CARD',
            'gcash' => 'GCASH',
            default => 'TXN',
        };

        return $prefix . '-' . time() . '-' . Auth::id() . '-' . strtoupper(substr(md5(uniqid()), 0, 6));
    }

    private function processPayment(string $paymentMethod, float $amount, Order $order): bool
    {
        return match ($paymentMethod) {
            'cash_on_delivery' => true,
            'credit_debit_card' => $this->processCreditCardPayment($amount, $order),
            'gcash' => $this->processGCashPayment($amount, $order),
            default => false,
        };
    }

    private function processCreditCardPayment(float $amount, Order $order): bool
    {
        // Placeholder for payment integration
        return true;
    }

    private function processGCashPayment(float $amount, Order $order): bool
    {
        // Placeholder for payment integration
        return true;
    }
}
