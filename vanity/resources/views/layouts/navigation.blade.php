<nav x-data="{ 
    open: false, 
    skinMenu: false, 
    lipsMenu: false, 
    faceMenu: false, 
    eyesMenu: false, 
    newMenu: false, 
    aboutMenu: false, 
    contactMenu: false 
}" class="bg-white border-b border-gray-100 relative">

    <!-- Promo Banner -->
    <div class="bg-black text-white text-center py-2 text-sm">
        ✨ Shop the latest beauty drops or book an appointment online! ✨
    </div>

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-900">VANITY</a>
            </div>

            <!-- Main Navigation Links (Centered) -->
            <div class="hidden lg:flex space-x-8 absolute left-1/2 transform -translate-x-1/2">
                <a href="#" @mouseenter="newMenu = true" @mouseleave="newMenu = false" class="text-gray-900 transition-colors">New Arrivals</a>
                <a href="{{ route('products.index', ['category' => 'Lips']) }}" @mouseenter="lipsMenu = true" @mouseleave="lipsMenu = false" class="text-gray-900 transition-colors">Lips</a>
                <a href="{{ route('products.index', ['category' => 'Face']) }}" @mouseenter="faceMenu = true" @mouseleave="faceMenu = false" class="text-gray-900 transition-colors">Face</a>
                <a href="{{ route('products.index', ['category' => 'Eyes']) }}" @mouseenter="eyesMenu = true" @mouseleave="eyesMenu = false" class="text-gray-900 transition-colors">Eyes</a>
                <a href="{{ route('products.index', ['category' => 'Skin']) }}" @mouseenter="skinMenu = true" @mouseleave="skinMenu = false" class="text-gray-900 transition-colors">Skin</a>
                <a href="#" @mouseenter="aboutMenu = true" @mouseleave="aboutMenu = false" class="text-gray-900 transition-colors">About Us</a>
                <a href="#" @mouseenter="contactMenu = true" @mouseleave="contactMenu = false" class="text-gray-900 transition-colors">Contact Us</a>
            </div>

            <!-- Right Side Icons -->
            <div class="flex items-center space-x-4">
                @if(Auth::check())
                    <div class="relative" x-data="{ accountMenu: false }">
                        <button @click="accountMenu = !accountMenu" class="text-gray-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </button>
                        <div x-show="accountMenu" @click.away="accountMenu = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Order History</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </a>
                @endif
                <a href="{{ route('cart.index') }}" class="text-gray-700 relative">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="absolute -top-2 -right-2 bg-black text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        {{ Auth::check() ? array_sum(session('cart', [])) : 0 }}
                    </span>
                </a>


                <button @click="open = !open" class="lg:hidden text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mega Menus -->
    @foreach(['skin','lips','face','eyes','new','about','contact'] as $menu)
    <div x-show="{{ $menu }}Menu"
         @mouseenter="{{ $menu }}Menu = true"
         @mouseleave="{{ $menu }}Menu = false"
         class="absolute top-full left-0 w-full bg-white border-t border-gray-200 shadow-lg z-40 hidden lg:block"
         x-transition>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-4 gap-8">

                @if($menu == 'lips')
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Lipsticks</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600">MAC Ruby Woo – Matte Red</a></li>
                        <li><a href="#" class="text-gray-600">Fenty Beauty Stunna Lip Paint – Uncensored</a></li>
                        <li><a href="#" class="text-gray-600">NYX Soft Matte Lip Cream – Prague</a></li>
                        <li><a href="#" class="text-gray-600">Maybelline SuperStay Matte Ink – Lover</a></li>
                        <li><a href="#" class="text-gray-600">Huda Beauty Liquid Matte – Bombshell</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Lip Glosses & Balms</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600">Fenty Gloss Bomb – Fuchsia Flush</a></li>
                        <li><a href="#" class="text-gray-600">Burt’s Bees Tinted Lip Balm – Red Dahlia</a></li>
                        <li><a href="#" class="text-gray-600">Glossier Lip Gloss – Clear Shine</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Featured Lips</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600">Pat McGrath Labs MatteTrance – Flesh 3</a></li>
                        <li><a href="#" class="text-gray-600">Kylie Cosmetics Matte Lip Kit – Candy K</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Shop All Lips</h3>
                    <div class="pt-4">
                        <a href="http://localhost:8000/products?category=Lips" class="text-pink-600 hover:text-pink-800 font-medium">View All Lip Products</a>
                    </div>
                </div>
                @elseif($menu == 'face')
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Foundations</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600">Estée Lauder Double Wear – Full Coverage</a></li>
                        <li><a href="#" class="text-gray-600">Maybelline Fit Me Foundation – Matte + Poreless</a></li>
                        <li><a href="#" class="text-gray-600">Fenty Beauty Pro Filt’r Soft Matte</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Blush & Highlighters</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600">NARS Blush – Orgasm</a></li>
                        <li><a href="#" class="text-gray-600">Benefit Watt’s Up Highlighter</a></li>
                        <li><a href="#" class="text-gray-600">Tarte Amazonian Clay Blush – Exposed</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Featured Face Products</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600">Hourglass Ambient Lighting Powder</a></li>
                        <li><a href="#" class="text-gray-600">Fenty Beauty Match Stix Trio</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Shop All Face</h3>
                    <div class="pt-4">
                        <a href="http://localhost:8000/products?category=Face" class="text-pink-600 hover:text-pink-800 font-medium">View All Face Products</a>
                    </div>
                </div>
                @elseif($menu == 'eyes')
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Eyeshadow Palettes</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600">Urban Decay Naked Palette</a></li>
                        <li><a href="#" class="text-gray-600">Huda Beauty Obsessions Palette – Smokey</a></li>
                        <li><a href="#" class="text-gray-600">Morphe 35O Nature Glow</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Mascaras & Liners</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600">Benefit Roller Lash Mascara</a></li>
                        <li><a href="#" class="text-gray-600">Maybelline Colossal Liner</a></li>
                        <li><a href="#" class="text-gray-600">NYX Brow Pencil</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Featured Eye Products</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600">Charlotte Tilbury Luxury Palette</a></li>
                        <li><a href="#" class="text-gray-600">Fenty Beauty Flyliner – Black</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Shop All Eyes</h3>
                    <div class="pt-4">
                        <a href="http://localhost:8000/products?category=Eyes" class="text-pink-600 hover:text-pink-800 font-medium">View All Eye Products</a>
                    </div>
                </div>
                @elseif($menu == 'skin')
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Serums & Treatments</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600">The Ordinary Niacinamide Serum</a></li>
                        <li><a href="#" class="text-gray-600">Drunk Elephant C-Firma Vitamin C</a></li>
                        <li><a href="#" class="text-gray-600">Kiehl’s Midnight Recovery Concentrate</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Moisturizers & Sunscreens</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600">CeraVe Moisturizing Cream</a></li>
                        <li><a href="#" class="text-gray-600">La Roche-Posay Sunscreen SPF 50</a></li>
                        <li><a href="#" class="text-gray-600">Clinique Moisture Surge 72H</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Featured Skin Products</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600">Tatcha Dewy Skin Mist</a></li>
                        <li><a href="#" class="text-gray-600">Fresh Rose Face Mask</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Shop All Skin</h3>
                    <div class="pt-4">
                        <a href="http://localhost:8000/products?category=Skin" class="text-pink-600 hover:text-pink-800 font-medium">View All Skincare</a>
                    </div>
                </div>
                @elseif($menu == 'new')
                <div class="space-y-4 col-span-4">
                    <h3 class="font-semibold text-gray-900">Latest Arrivals</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600">Rare Beauty Soft Pinch Blush – Joy</a></li>
                        <li><a href="#" class="text-gray-600">Huda Beauty Liquid Matte – Trendsetter</a></li>
                        <li><a href="#" class="text-gray-600">Fenty Beauty Gloss Bomb – Diamond Milk</a></li>
                        <li><a href="#" class="text-gray-600">Tatcha Luminous Dewy Skin Mist</a></li>
                        <li><a href="#" class="text-gray-600">Kylie Cosmetics Creme Shadow Palette</a></li>
                    </ul>
                </div>
                @elseif($menu == 'about')
                <div class="space-y-4 col-span-4">
                    <h3 class="font-semibold text-gray-900">About Vanity</h3>
                    <p class="text-gray-600">Vanity is your go-to online beauty store, offering the latest makeup and skincare products from top brands. Our mission is to empower self-expression through beauty. Founded in 2023, we pride ourselves on quality products, fast delivery, and friendly service. We also provide expert beauty advice and personalized recommendations.</p>
                </div>
                @elseif($menu == 'contact')
                <div class="space-y-4 col-span-4">
                    <h3 class="font-semibold text-gray-900">Contact Us</h3>
                    <p class="text-gray-600">Have questions? Reach out to us:</p>
                    <ul class="space-y-1 text-gray-600">
                        <li>Email: support@vanitybeauty.com</li>
                        <li>Phone: +63 912 345 6789</li>
                        <li>Address: 123 Beauty Lane, Cebu, Philippines</li>
                        <li>Live Chat: Available Mon–Fri, 9AM–6PM</li>
                    </ul>
                </div>
                @endif

            </div>
        </div>
    </div>
    @endforeach
</nav>
