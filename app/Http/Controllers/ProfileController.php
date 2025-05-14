<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

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

    public function confirmShipment($orderId)
    {
        $user = Auth::user();

        $shipment = Shipment::where('order_id', $orderId)
            ->where('user_id', $user->id)
            ->first();

        if (!$shipment) {
            return redirect()->back()->with('error', 'Data pengiriman tidak ditemukan.');
        }

        $shipment->shipping_status = 'diterima';
        $shipment->save();

        $order = Order::find($orderId);
        if ($order) {
            $order->status = 'completed';
            $order->save();
        }

        return redirect()->back()->with('success', 'Barang telah dikonfirmasi diterima.');
    }
}
