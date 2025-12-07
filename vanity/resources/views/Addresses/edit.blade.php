<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Update Profile Info --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update Password --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Manage Addresses --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold mb-4">Your Addresses</h3>

                    {{-- List of addresses --}}
                    @if(Auth::user()->addresses->count() > 0)
                        <ul class="space-y-2 mb-4">
                            @foreach(Auth::user()->addresses as $address)
                                <li class="border rounded p-4 flex justify-between items-center">
                                    <div>
                                        <div class="font-medium">{{ $address->label }}</div>
                                        <div class="text-sm text-gray-600">
                                            {{ $address->line1 }}@if($address->line2), {{ $address->line2 }}@endif
                                            <br>
                                            {{ $address->city }}, {{ $address->region }}@if($address->postal_code) {{ $address->postal_code }}@endif
                                            <br>
                                            {{ $address->country }}
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('addresses.edit', $address->id) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                                        <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this address?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 mb-4">You have no saved addresses.</p>
                    @endif

                    {{-- Add new address --}}
                    <a href="{{ route('addresses.create') }}" class="inline-block bg-pink-500 text-white px-4 py-2 rounded-md hover:bg-pink-600">
                        Add New Address
                    </a>
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
