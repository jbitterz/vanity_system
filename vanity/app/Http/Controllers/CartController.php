<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $items = [];
        $subtotal = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'total' => $product->price * $quantity,
                ];
                $subtotal += $product->price * $quantity;
            }
        }

        $shipping = 120.00;
        $tax = $subtotal * 0.12; // 12% tax
        $total = $subtotal + $shipping + $tax;

        return view('cart.index', compact('items', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = Session::get('cart', []);
        $quantity = $request->input('quantity', 1);

        if ($product->stock < ($cart[$product->id] ?? 0) + $quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cart[$product->id] = ($cart[$product->id] ?? 0) + $quantity;
        Session::put('cart', $cart);

        return back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, Product $product)
    {
        $cart = Session::get('cart', []);
        $quantity = $request->input('quantity', 1);

        if ($quantity <= 0) {
            unset($cart[$product->id]);
        } else {
            if ($product->stock < $quantity) {
                return back()->with('error', 'Not enough stock available.');
            }
            $cart[$product->id] = $quantity;
        }

        Session::put('cart', $cart);
        return back()->with('success', 'Cart updated!');
    }

    public function remove(Product $product)
    {
        $cart = Session::get('cart', []);
        unset($cart[$product->id]);
        Session::put('cart', $cart);

        return back()->with('success', 'Product removed from cart!');
    }
}
