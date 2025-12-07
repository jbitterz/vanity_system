<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Address
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('addresses.store') }}">
                    @csrf

                    <x-input-label for="label" value="Label (Home, Office, etc.)" />
                    <x-text-input id="label" name="label" type="text" class="mt-1 block w-full" value="{{ old('label') }}" required />
                    <x-input-error :messages="$errors->get('label')" class="mt-2" />

                    <x-input-label for="line1" value="Address Line 1" class="mt-4"/>
                    <x-text-input id="line1" name="line1" type="text" class="mt-1 block w-full" value="{{ old('line1') }}" required />
                    <x-input-error :messages="$errors->get('line1')" class="mt-2" />

                    <x-input-label for="line2" value="Address Line 2 (optional)" class="mt-4"/>
                    <x-text-input id="line2" name="line2" type="text" class="mt-1 block w-full" value="{{ old('line2') }}" />
                    <x-input-error :messages="$errors->get('line2')" class="mt-2" />

                    <x-input-label for="city" value="City" class="mt-4"/>
                    <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" value="{{ old('city') }}" required />
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />

                    <x-input-label for="region" value="Region/State" class="mt-4"/>
                    <x-text-input id="region" name="region" type="text" class="mt-1 block w-full" value="{{ old('region') }}" required />
                    <x-input-error :messages="$errors->get('region')" class="mt-2" />

                    <x-input-label for="postal_code" value="Postal Code" class="mt-4"/>
                    <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" value="{{ old('postal_code') }}" />
                    <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />

                    <x-input-label for="country" value="Country" class="mt-4"/>
                    <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" value="{{ old('country') }}" required />
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />

                    <div class="mt-6">
                        <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-md hover:bg-pink-600">
                            Save Address
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
