<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Tampilkan isi cart
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('components.cart', compact('cart'));
    }


    // Tambah produk ke cart
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Cek apakah stok produk masih tersedia
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Produk ini sudah habis, tidak dapat ditambahkan ke keranjang!');
        }

        // Ambil cart dari session
        $cart = session()->get('cart', []);

        // Jika produk sudah ada dalam cart, tambah kuantitasnya
        if (isset($cart[$id])) {
            // Cek apakah jumlah yang diminta melebihi stok
            if ($cart[$id]['quantity'] < $product->stock) {
                $cart[$id]['quantity']++;
            } else {
                return redirect()->back()->with('error', 'Stok produk tidak cukup untuk ditambahkan!');
            }
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img,
                'quantity' => 1
            ];
        }

        // Simpan cart ke session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }


    // Hapus produk dari cart
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    // Update quantity produk di cart
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Jumlah produk diperbarui.');
    }

    // Kosongkan seluruh keranjang
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Keranjang dikosongkan.');
    }
}
