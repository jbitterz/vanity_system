<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Checkout
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- LEFT SIDE: Order Summary + Address -->
                    <div class="lg:col-span-2">

                        <!-- Order Summary -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Order Summary</h3>

                                @foreach($items as $item)
                                    <div class="flex items-center gap-4 border-b pb-4 mb-4">
                                        <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                                            @if($item['product']->image_url)
                                                <img src="{{ $item['product']->image_url }}"
                                                     alt="{{ $item['product']->name }}"
                                                     class="w-full h-full object-cover rounded">
                                            @else
                                                <span class="text-gray-400 text-xs">No Image</span>
                                            @endif
                                        </div>

                                        <div class="flex-1">
                                            <h4 class="font-semibold">{{ $item['product']->name }}</h4>
                                            <p class="text-sm text-gray-500">{{ $item['product']->brand }}</p>
                                            <p class="text-lg font-bold">₱{{ number_format($item['product']->price, 2) }}</p>
                                            <p class="text-sm text-gray-600">Quantity: {{ $item['quantity'] }}</p>
                                        </div>

                                        <div class="text-right">
                                            <p class="font-semibold">₱{{ number_format($item['total'], 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <!-- Delivery Address -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Delivery Address</h3>

                                @if($addresses && $addresses->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($addresses as $address)
                                            <label class="flex items-start space-x-3 p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                                <input type="radio" name="address_id" value="{{ $address->id }}"
                                                       class="mt-1 text-pink-600 focus:ring-pink-500"
                                                       {{ $loop->first ? 'checked' : '' }}>

                                                <div class="flex-1">
                                                    <div class="font-medium">{{ $address->label }}</div>
                                                    <div class="text-gray-600 text-sm">
                                                        {{ $address->line1 }}@if($address->line2), {{ $address->line2 }}@endif
                                                        <br>
                                                        {{ $address->city }}, {{ $address->region }}@if($address->postal_code) {{ $address->postal_code }}@endif
                                                        <br>
                                                        {{ $address->country }}
                                                    </div>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <p class="text-gray-500 mb-4">You don't have any saved addresses.</p>
                                        <a href="{{ route('profile.edit') }}" class="text-pink-600 hover:text-pink-800">
                                            Add an address to your profile
                                        </a>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Contact Information</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name', Auth::user()->full_name) }}"
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" required>
                                        @error('full_name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" required>
                                        @error('email')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                        <input type="tel" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" required>
                                        @error('phone')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Coupon Code lol not continued -->
                        <!-- Payment Method -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Payment Method</h3>
                                <div class="space-y-4">
                                    <label class="flex items-center space-x-3 p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="cash_on_delivery"
                                               class="text-pink-600 focus:ring-pink-500" checked>
                                        <span class="font-medium">Cash on Delivery</span>
                                    </label>
                                    <label class="flex items-center space-x-3 p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="credit_debit_card"
                                               class="text-pink-600 focus:ring-pink-500">
                                        <span class="font-medium">Credit/Debit Card</span>
                                    </label>
                                    <label class="flex items-center space-x-3 p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="gcash"
                                               class="text-pink-600 focus:ring-pink-500">
                                        <span class="font-medium">GCash</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT SIDE: Totals + Button -->
                    <div class="lg:col-span-1">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sticky top-4">
                            <h3 class="text-lg font-semibold mb-4">Order Total</h3>

                            <div class="space-y-2 mb-4">
                                <div class="flex justify-between">
                                    <span>Subtotal:</span>
                                    <span id="subtotal">₱{{ number_format($subtotal, 2) }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span>Discount:</span>
                                    <span id="discount">₱{{ number_format($discount ?? 0, 2) }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span>Shipping:</span>
                                    <span id="shipping">₱{{ number_format($shipping, 2) }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span>Tax (12%):</span>
                                    <span id="tax">₱{{ number_format($tax, 2) }}</span>
                                </div>

                                <div class="border-t pt-2 mt-2">
                                    <div class="flex justify-between font-bold text-lg">
                                        <span>Total:</span>
                                        <span id="total">₱{{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            @if($addresses && $addresses->count() > 0)
                                <button type="submit"
                                        class="block w-full bg-pink-500 text-white text-center px-4 py-2 rounded-md hover:bg-pink-600">
                                    Place Order
                                </button>
                            @else
                                <div class="block w-full bg-gray-300 text-gray-500 text-center px-4 py-2 rounded-md cursor-not-allowed">
                                    Add Address to Continue
                                </div>
                            @endif

                            <a href="{{ route('cart.index') }}"
                               class="block text-center mt-2 text-gray-600 hover:text-gray-800">
                                Back to Cart
                            </a>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

</x-app-layout>
