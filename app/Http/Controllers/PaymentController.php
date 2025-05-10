<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Menampilkan halaman checkout (produk yang akan dibayar)
    public function checkout()
    {
        // Ambil data cart dari session
        $cart = session()->get('cart', []);

        // Cek apakah cart kosong
        if (empty($cart)) {
            return redirect()->route('/')->with('warning', 'Keranjang kosong, tidak bisa lanjut ke pembayaran.');
        }

        // Hitung total harga dari semua produk di cart
        $total = collect($cart)->reduce(function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Kirim data ke view checkout
        return view('components.detailPembayaran', compact('cart', 'total'));
    }

    // Proses pembayaran (ini bisa disesuaikan dengan implementasi payment gateway)
    public function processPayment(Request $request)
    {
        // Di sini, Anda bisa menghubungkan dengan API pembayaran atau sistem lainnya.
        // Misalnya, menghapus cart setelah pembayaran sukses.

        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Pembayaran berhasil! Terima kasih.');
    }
}
