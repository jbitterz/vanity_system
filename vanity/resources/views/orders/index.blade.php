<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order History
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($orders->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No orders yet</h3>
                        <p class="text-gray-500 mb-6">You haven't placed any orders yet. Start shopping to see your order history here.</p>
                        <a href="{{ route('products.index') }}" class="inline-block bg-pink-500 text-white px-6 py-2 rounded-md hover:bg-pink-600">
                            Start Shopping
                        </a>
                    </div>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($orders as $order)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold">Order #{{ $order->id }}</h3>
                                        <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('M d, Y') }}</p>
                                        <p class="text-sm text-gray-500">Status: <span class="capitalize {{ $order->status === 'paid' ? 'text-green-600' : 'text-yellow-600' }}">{{ $order->status }}</span></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold">₱{{ number_format($order->total, 2) }}</p>
                                        <p class="text-sm text-gray-500">Transaction ID: {{ $order->transaction_id }}</p>
                                    </div>
                                </div>

                                <!-- Order Items -->
                                <div class="border-t pt-4">
                                    <h4 class="font-semibold mb-3">Items</h4>
                                    @foreach($order->orderItems as $item)
                                        <div class="flex items-center gap-4 border-b pb-3 mb-3 last:border-b-0 last:pb-0 last:mb-0">
                                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                                @if($item->product && $item->product->image_url)
                                                    <img src="{{ $item->product->image_url }}"
                                                         alt="{{ $item->product->name }}"
                                                         class="w-full h-full object-cover rounded">
                                                @else
                                                    <span class="text-gray-400 text-xs">No Image</span>
                                                @endif
                                            </div>

                                            <div class="flex-1">
                                                <h5 class="font-medium">{{ $item->product ? $item->product->name : 'Product Unavailable' }}</h5>
                                                <p class="text-sm text-gray-500">{{ $item->brand }}</p>
                                                <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }} × ₱{{ number_format($item->unit_price, 2) }}</p>
                                            </div>

                                            <div class="text-right">
                                                <p class="font-semibold">₱{{ number_format($item->line_total, 2) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Order Summary -->
                                <div class="border-t pt-4 mt-4">
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <p><strong>Subtotal:</strong> ₱{{ number_format($order->subtotal, 2) }}</p>
                                            <p><strong>Shipping:</strong> ₱{{ number_format($order->shipping_fee, 2) }}</p>
                                            <p><strong>Tax:</strong> ₱{{ number_format($order->tax_amount, 2) }}</p>
                                            @if($order->discount_amount > 0)
                                                <p><strong>Discount:</strong> -₱{{ number_format($order->discount_amount, 2) }}</p>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-lg">Total: ₱{{ number_format($order->total, 2) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Shipping Address -->
                                <div class="border-t pt-4 mt-4">
                                    <h4 class="font-semibold mb-2">Shipping Address</h4>
                                    <div class="text-sm text-gray-600">
                                        @if($order->shipping_address)
                                            <p>{{ $order->shipping_address['line1'] }}</p>
                                            @if(isset($order->shipping_address['line2']) && $order->shipping_address['line2'])
                                                <p>{{ $order->shipping_address['line2'] }}</p>
                                            @endif
                                            <p>{{ $order->shipping_address['city'] }}, {{ $order->shipping_address['region'] }} {{ $order->shipping_address['postal_code'] }}</p>
                                            <p>{{ $order->shipping_address['country'] }}</p>
                                        @else
                                            <p>Address not available</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
