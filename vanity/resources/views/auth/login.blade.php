<x-guest-layout title="Welcome Back">

    <div class="max-w-md mx-auto mt-12 bg-pink-50 border border-pink-200 p-8 rounded-xl shadow-lg">

        <h2 class="text-2xl font-semibold text-pink-700 mb-6 text-center">Welcome Back</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="text-sm font-medium text-pink-700">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    class="w-full mt-1 rounded-lg border-pink-300 focus:border-pink-500 focus:ring-pink-500 p-2"
                />
                <x-input-error :messages="$errors->get('email')" class="text-red-500 text-sm mt-1" />
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label for="password" class="text-sm font-medium text-pink-700">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="w-full mt-1 rounded-lg border-pink-300 focus:border-pink-500 focus:ring-pink-500 p-2"
                />
                <x-input-error :messages="$errors->get('password')" class="text-red-500 text-sm mt-1" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-6">
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded border-pink-300 text-pink-600 focus:ring-pink-500"
                />
                <label for="remember_me" class="ml-2 text-sm text-pink-700">
                    Remember me
                </label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between mb-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-pink-600 hover:text-pink-700 hover:underline transition">
                        Forgot your password?
                    </a>
                @endif

                <button
                    type="submit"
                    class="bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700 transition">
                    Sign In
                </button>
            </div>
        </form>

        <!-- Register Link -->
        <div class="mt-6 text-center">
            <span class="text-sm text-pink-700">Don't have an account?</span>
            <a href="{{ route('register') }}"
               class="ml-2 text-sm text-pink-600 hover:text-pink-700 hover:underline transition">
                Register
            </a>
        </div>

    </div>
</x-guest-layout>
