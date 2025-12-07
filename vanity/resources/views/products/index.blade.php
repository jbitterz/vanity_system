<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-pink-50 via-rose-50 to-purple-50">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-rose-500 via-pink-500 to-purple-500 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4 bg-gradient-to-r from-white to-pink-100 bg-clip-text text-transparent">
                    Discover Your Beauty
                </h1>
                <p class="text-xl md:text-2xl text-pink-100 mb-8 max-w-3xl mx-auto">
                    Premium makeup products curated for your unique style
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#products" class="bg-white text-rose-600 px-8 py-3 rounded-full font-semibold hover:bg-pink-50 transition-all duration-300 transform hover:scale-105 flex flex-col items-center">
                    <span>Shop Products</span>
                    <span class="text-sm text-rose-200 mt-1">Sephora, MAC, Maybelline, Olay, and LOréal.</span>
                    </a>
                    <a href="#categories" 
                        class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-rose-600 transition-all duration-300 flex flex-col items-center">
                        
                        <span>Browse Categories</span>
                        <span class="text-sm text-pink-200 mt-1">Face, Lips, Eyes, Skin, Tools</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Filters Section -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl border border-pink-100 p-6 mb-8" id="filters">
                <form method="GET" action="{{ route('products.index') }}" class="flex flex-col lg:flex-row gap-4 items-start lg:items-end">
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 text-pink-800">Search Products</label>
                        <div class="relative">
                            <input type="text" name="q" value="{{ request('q') }}"
                                   placeholder="Search for makeup, skincare, tools..."
                                   class="w-full pl-12 pr-4 py-3 border-2 border-pink-200 rounded-xl bg-white/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent text-gray-700 placeholder-gray-400">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-48">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 text-pink-800">Brand</label>
                        <select name="brand" class="w-full px-4 py-3 border-2 border-pink-200 rounded-xl bg-white/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent text-gray-700">
                            <option value="">All Brands</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>
                                    {{ $brand }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full lg:w-48">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 text-pink-800">Category</label>
                        <select name="category" class="w-full px-4 py-3 border-2 border-pink-200 rounded-xl bg-white/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent text-gray-700">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-gradient-to-r from-rose-500 to-pink-500 text-white px-6 py-3 rounded-xl font-semibold hover:from-rose-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            Filter
                        </button>
                        @if(request('q') || request('brand') || request('category'))
                            <a href="{{ route('products.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-300 transition-all duration-300">
                                Clear All
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Products Grid -->
            <div id="products">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        @foreach($products as $product)
                            <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl border border-pink-100 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                                <!-- Product Image -->
                                <div class="relative h-64 bg-gradient-to-br from-pink-100 to-rose-100 overflow-hidden">
                                    @if($product->image_url)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <div class="text-center">
                                                <svg class="w-16 h-16 text-pink-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="text-pink-400 font-medium">No Image</span>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Overlay on hover -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                    <!-- Quick actions -->
                                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-lg hover:bg-white transition-colors duration-200">
                                            <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Product Info -->
                                <div class="p-6">
                                    <!-- Brand Badge -->
                                    <div class="mb-3">
                                        <span class="inline-block bg-gradient-to-r from-rose-100 to-pink-100 text-rose-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ $product->brand }}
                                        </span>
                                    </div>

                                    <!-- Product Name -->
                                    <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2 group-hover:text-rose-600 transition-colors duration-200">
                                        {{ $product->name }}
                                    </h3>

                                    <!-- Description -->
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ $product->description }}
                                    </p>

                                    <!-- Price -->
                                    <div class="mb-4">
                                        <span class="text-3xl font-bold bg-gradient-to-r from-rose-600 to-pink-600 bg-clip-text text-transparent">
                                            ₱{{ number_format($product->price, 2) }}
                                        </span>
                                    </div>

                                    <!-- Stock & Actions -->
                                    <div class="space-y-3">
                                        <p class="text-sm text-gray-500">
                                            <span class="inline-block w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                                            {{ $product->stock }} in stock
                                        </p>

                                        <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-3">
                                            @csrf
                                            <div class="flex items-center gap-3">
                                                <label class="text-sm font-medium text-gray-700">Qty:</label>
                                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                                       class="w-20 px-3 py-2 border-2 border-pink-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent text-center">
                                            </div>

                                            <button type="submit"
                                                    class="w-full bg-gradient-to-r from-rose-500 to-pink-500 text-white py-3 px-6 rounded-xl font-semibold hover:from-rose-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 shadow-lg disabled:from-gray-400 disabled:to-gray-500 disabled:cursor-not-allowed disabled:transform-none"
                                                    {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                                <div class="flex items-center justify-center gap-2">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M7 13v8a2 2 0 002 2h10a2 2 0 002-2v-3"></path>
                                                    </svg>
                                                    {{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center">
                        <div class="bg-white/80 backdrop-blur-md rounded-xl shadow-lg border border-pink-100 p-4">
                            {{ $products->links() }}
                        </div>
                    </div>
                @else
                    <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl border border-pink-100 p-12 text-center">
                        <div class="mb-6">
                            <svg class="w-24 h-24 text-pink-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">No products found</h3>
                        <p class="text-gray-600 mb-6">Try adjusting your search criteria or browse our full collection.</p>
                        <a href="{{ route('products.index') }}" class="bg-gradient-to-r from-rose-500 to-pink-500 text-white px-8 py-3 rounded-xl font-semibold hover:from-rose-600 hover:to-pink-600 transition-all duration-300 inline-block">
                            View All Products
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
