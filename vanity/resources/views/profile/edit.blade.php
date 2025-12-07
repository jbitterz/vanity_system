<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h3 class="text-lg font-semibold mb-4 text-pink-600">Delivery Addresses</h3>

                <!-- List existing addresses -->
                @if(Auth::user()->addresses && Auth::user()->addresses->count() > 0)
                    <ul class="space-y-4">
                        @foreach(Auth::user()->addresses as $address)
                            <li class="border border-pink-200 rounded-lg p-4 flex justify-between items-start bg-pink-50">
                                <div>
                                    <div class="font-medium text-gray-800">{{ $address->label }}</div>
                                    <div class="text-gray-600 text-sm">
                                        {{ $address->line1 }}@if($address->line2), {{ $address->line2 }}@endif
                                        <br>
                                        {{ $address->city }}, {{ $address->region }} @if($address->postal_code) {{ $address->postal_code }}@endif
                                        <br>
                                        {{ $address->country }}
                                    </div>
                                </div>
                                <div class="space-x-2">
                                    <a href="{{ route('addresses.edit', $address) }}" class="text-pink-600 hover:text-pink-800 hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('addresses.destroy', $address) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 mb-4">You have no saved addresses.</p>
                @endif

                <!-- Add new address button -->
                <a href="{{ route('addresses.create') }}" class="mt-4 inline-block bg-pink-500 text-white px-4 py-2 rounded-md hover:bg-pink-600 transition duration-200">
                    Add New Address
                </a>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
