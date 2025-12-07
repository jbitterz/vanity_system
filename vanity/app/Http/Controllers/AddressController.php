<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    // Show list of addresses (optional if already in profile page)
    public function index()
    {
        $addresses = Auth::user()->addresses;
        return view('addresses.index', compact('addresses'));
    }

    // Show form to create new address
    public function create()
    {
        return view('addresses.create');
    }

    // Store new address
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'line1' => 'required|string|max:255',
            'line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        Auth::user()->addresses()->create($request->all());

        return redirect()->route('profile.edit')->with('success', 'Address added successfully.');
    }

    // Show form to edit existing address
    public function edit(Address $address)
    {
        $this->authorize('update', $address); // ensure user owns the address
        return view('addresses.edit', compact('address'));
    }

    // Update address
    public function update(Request $request, Address $address)
    {
        $this->authorize('update', $address);

        $request->validate([
            'label' => 'required|string|max:255',
            'line1' => 'required|string|max:255',
            'line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        $address->update($request->all());

        return redirect()->route('profile.edit')->with('success', 'Address updated successfully.');
    }

    // Delete address
    public function destroy(Address $address)
    {
        $this->authorize('delete', $address);
        $address->delete();

        return redirect()->route('profile.edit')->with('success', 'Address deleted successfully.');
    }
}
