<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Confirmation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <div class="mb-6">
                        <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Order Placed Successfully!</h3>

                    <p class="text-green-600 font-semibold mb-4">Payment processed successfully.</p>

                    <p class="text-gray-600 mb-6">
                        Thank you for your order. We've received your order and will process it shortly.
                        You will receive an email confirmation with your order details.
                    </p>

                    <div class="space-y-4">
                        <a href="{{ route('products.index') }}" class="inline-block bg-pink-500 text-white px-6 py-2 rounded-md hover:bg-pink-600">
                            Continue Shopping
                        </a>

                        <div class="block">
                            <a href="{{ route('orders.index') }}" class="text-pink-600 hover:text-pink-800">
                                View Order History
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
