<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        // Ambil semua order milik user
        $orders = Order::where('user_id', $user->id)->get();

        $payments = Payment::whereIn('order_id', $orders->pluck('id'))
            ->with([
                'order',
                'order.orderItems.product',
                'order.shipment' 
            ])
            ->latest()
            ->get();

        return view('components.profile', compact('user', 'payments'));
    }
}
