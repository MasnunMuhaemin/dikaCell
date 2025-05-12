<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
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
            'payment_method' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'desa' => 'required|string',
            'kode_pos' => 'required|string',
            'shipping_cost' => 'required|numeric',
        ]);

        $cart = session()->get('cart', []);
        $totalAmount = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if (!$product) {
                continue;
            }

            $subtotal = ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
            $total = $subtotal + $request->shipping_cost;
            $totalAmount += $total;

            // ✅ Simpan ke tabel `cart`
            $cartEntry = new \App\Models\Cart();
            $cartEntry->user_id = Auth::id();
            $cartEntry->product_id = $productId;
            $cartEntry->quantity = $item['quantity'];
            $cartEntry->save();

            // Gunakan ID cart barusan
            $cartId = $cartEntry->id;

            // 1. Buat Order
            $order = new Order();
            $order->user_id = Auth::id();
            $order->cart_id = $cartId;
            $order->order_date = now();
            $order->total_price = $total;
            $order->status = 'pending';
            $order->save();

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $productId;
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $product->price;
            $orderItem->save();

            // 2. Payment
            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->user_id = Auth::id();
            $payment->payment_method = $request->payment_method;
            $payment->payment_status = 'paid';
            $payment->payment_date = now();
            $payment->amount = $total;
            $payment->save();

            // 3. Shipment
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

            // 4. Kurangi stok
            $product->stock -= $item['quantity'];
            $product->save();
        }

        // Kosongkan session cart
        session()->forget('cart');

        // Update badge
        $user = Auth::user();
        $totalPaid = Payment::where('user_id', $user->id)->where('payment_status', 'paid')->count();

        if ($totalPaid >= 10) {
            $user->badge = 'platinum';
        } elseif ($totalPaid >= 5) {
            $user->badge = 'gold';
        } else {
            $user->badge = 'bronze';
        }
        $user->save();

        return redirect()->route('profile')
            ->with('success', 'Pembayaran berhasil. Semua order telah dikirim ke admin untuk dikonfirmasi.');
    }
}
