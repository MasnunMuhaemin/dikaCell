<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    public function showPayment($orderId)
    {
        $order = Order::findOrFail($orderId);

        $payment = Payment::where('order_id', $orderId)->first();

        $cart = session()->get('cart', []);

        return view('components.detailPembayaran', [
            'order' => $order,
            'payment' => $payment,
            'cart' => $cart,
        ]);
    }


    public function processPayment(Request $request)
    {
        $request->validate([
            'orderId' => 'required|exists:orders,id',
            'payment_method' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'desa' => 'required|string',
            'kode_pos' => 'required|string',
            'shipping_cost' => 'required|numeric',
        ]);

        $order = Order::findOrFail($request->orderId);

        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
        }
        $totalAmount = $subtotal + $request->shipping_cost;

        $payment = new Payment();
        $payment->order_id = $order->id;
        $payment->payment_method = $request->payment_method;
        $payment->payment_status = 'pending';
        $payment->payment_date = now();
        $payment->amount = $totalAmount;
        $payment->save();
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $product->stock -= $item['quantity'];
                $product->save();
            }
        }

        $shipment = new Shipment();
        $shipment->user_id = Auth::id();
        $shipment->order_id = $order->id;  
        $shipment->shipment_date = now();
        $shipment->alamat_lengkap = $request->alamat_lengkap;
        $shipment->kota = $request->kota;
        $shipment->kecamatan = $request->kecamatan;
        $shipment->desa = $request->desa;
        $shipment->kode_pos = $request->kode_pos;
        $shipment->shipping_cost = $request->shipping_cost;
        $shipment->shipping_status = 'belum dikirim';
        $shipment->save();

        // Update status order
        // $order->status = 'belum dikirim';
        // $order->save();

        session()->forget('cart');

        return redirect()->route('checkout.payment', ['orderId' => $order->id])
            ->with('success', 'Pembayaran berhasil. Data pengiriman telah disimpan.');
    }
}
