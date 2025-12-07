<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(count($items) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Cart Items</h3>
                                @foreach($items as $item)
                                    <div class="flex items-center gap-4 border-b pb-4 mb-4">
                                        <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                                            @if($item['product']->image_url)
                                                <img src="{{ $item['product']->image_url }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover rounded">
                                            @else
                                                <span class="text-gray-400 text-xs">No Image</span>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold">{{ $item['product']->name }}</h4>
                                            <p class="text-sm text-gray-500">{{ $item['product']->brand }}</p>
                                            <p class="text-lg font-bold">₱{{ number_format($item['product']->price, 2) }}</p>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                                       min="1" max="{{ $item['product']->stock }}" 
                                                       class="w-16 rounded border-gray-300">
                                                <button type="submit" class="text-blue-500 hover:text-blue-700">Update</button>
                                            </form>
                                            <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                                            </form>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold">₱{{ number_format($item['total'], 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sticky top-4">
                            <h3 class="text-lg font-semibold mb-4">Order Summary</h3>
                            <div class="space-y-2 mb-4">
                                <div class="flex justify-between">
                                    <span>Subtotal:</span>
                                    <span>₱{{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Shipping:</span>
                                    <span>₱{{ number_format($shipping, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Tax (12%):</span>
                                    <span>₱{{ number_format($tax, 2) }}</span>
                                </div>
                                <div class="border-t pt-2 mt-2">
                                    <div class="flex justify-between font-bold text-lg">
                                        <span>Total:</span>
                                        <span>₱{{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ Auth::check() ? route('checkout.index') : route('login') }}"
                                class="block w-full bg-pink-500 text-white text-center px-4 py-2 rounded-md hover:bg-pink-600">
                                    Proceed to Checkout
                                </a>

                            <a href="{{ route('products.index') }}" class="block text-center mt-2 text-gray-600 hover:text-gray-800">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-gray-500 mb-4">Your cart is empty.</p>
                    <a href="{{ route('products.index') }}" class="text-blue-500 hover:text-blue-700">
                        Browse Products
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>


