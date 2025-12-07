<x-guest-layout>

    <div class="max-w-md mx-auto mt-12 bg-pink-50 border border-pink-200 p-8 rounded-xl shadow-lg">

        <h2 class="text-2xl font-semibold text-pink-700 mb-6 text-center">Create Your Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="text-sm font-medium text-pink-700">Name</label>
                <x-text-input
                    id="full_name"
                    type="text"
                    name="full_name"
                    :value="old('full_name')"
                    required
                    autofocus
                    autocomplete="name"
                    class="w-full mt-1 rounded-lg border-pink-300 focus:border-pink-500 focus:ring-pink-500"
                />

                <x-input-error :messages="$errors->get('name')" class="text-red-500 text-sm mt-1" />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="text-sm font-medium text-pink-700">Email</label>
                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autocomplete="username"
                    class="w-full mt-1 rounded-lg border-pink-300 focus:border-pink-500 focus:ring-pink-500"
                />
                <x-input-error :messages="$errors->get('email')" class="text-red-500 text-sm mt-1" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="text-sm font-medium text-pink-700">Password</label>
                <x-text-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    class="w-full mt-1 rounded-lg border-pink-300 focus:border-pink-500 focus:ring-pink-500"
                />
                <x-input-error :messages="$errors->get('password')" class="text-red-500 text-sm mt-1" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="text-sm font-medium text-pink-700">
                    Confirm Password
                </label>
                <x-text-input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    class="w-full mt-1 rounded-lg border-pink-300 focus:border-pink-500 focus:ring-pink-500"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="text-red-500 text-sm mt-1" />
            </div>

            <!-- Footer Links + Button -->
            <div class="flex items-center justify-between mt-6">

                <a
                    href="{{ route('login') }}"
                    class="text-sm text-pink-600 hover:text-pink-700 hover:underline transition"
                >
                    Already registered?
                </a>

                <button
                    class="bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700 transition"
                >
                    Register
                </button>

            </div>

        </form>
    </div>

</x-guest-layout>
