<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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

        $user = auth()->user();

        return view('components.detailPembayaran', [
            'order' => $order,
            'payment' => $payment,
            'cart' => $cart,
            'user' => $user,
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
        $totalSubtotal = 0;
        $user = Auth::user(); 

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if (!$product) {
                continue;
            }

            $discountPercentage = 0;
            if ($user->badge === 'Platinum') {
                $discountPercentage = 15; 
            } elseif ($user->badge === 'Gold') {
                $discountPercentage = 10; 
            }

            $discountedPrice = $product->price * (1 - $discountPercentage / 100);
            $totalSubtotal += $discountedPrice * $item['quantity'];

            $cartEntry = new Cart();
            $cartEntry->user_id = Auth::id();
            $cartEntry->product_id = $productId;
            $cartEntry->quantity = $item['quantity'];
            $cartEntry->save();

            $cartId = $cartEntry->id;

            $order = new Order();
            $order->user_id = Auth::id();
            $order->cart_id = $cartId;
            $order->order_date = now();
            $order->status = 'pending';
            $order->total_price = $totalSubtotal;
            $order->save();

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $productId;
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $discountedPrice;  
            $orderItem->save();

            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->user_id = Auth::id();
            $payment->payment_method = $request->payment_method;
            $payment->payment_status = 'paid';
            $payment->payment_date = now();
            $payment->amount = $totalSubtotal; 
            $payment->save();

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

            $product->stock -= $item['quantity'];
            $product->save();
        }

        session()->forget('cart');

        $totalPaid = Payment::where('user_id', $user->id)
            ->where('payment_status', 'paid')
            ->count();

        if ($totalPaid >= 10) {
            $user->badge = 'Platinum';
            $discountPercentage = 15;
        } elseif ($totalPaid >= 5) {
            $user->badge = 'Gold';
            $discountPercentage = 10;
        } else {
            $user->badge = 'Bronze';
            $discountPercentage = 0;
        }

        $user->save();

        return redirect()->route('profile')
            ->with('success', 'Pembayaran berhasil. Semua order telah dikirim ke admin untuk dikonfirmasi.');
    }
}
