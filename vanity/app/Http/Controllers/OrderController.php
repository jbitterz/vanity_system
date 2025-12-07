<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a list of the authenticated user's orders.
     */
    public function index()
    {
        $user = Auth::user();

        // Make sure the User model has an orders() relationship
        $orders = $user->orders()->with('orderItems.product')->orderBy('created_at', 'desc')->get();

        return view('orders.index', compact('orders'));
    }
}
