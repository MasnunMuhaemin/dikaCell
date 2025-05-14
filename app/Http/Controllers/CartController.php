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


    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Produk ini sudah habis, tidak dapat ditambahkan ke keranjang!');
        }

        $finalPrice = $product->price;
        if ($product->discount && $product->discount > 0) {
            $discountAmount = ($product->price * $product->discount) / 100;
            $finalPrice = $product->price - $discountAmount;
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] < $product->stock) {
                $cart[$id]['quantity']++;
            } else {
                return redirect()->back()->with('error', 'Stok produk tidak cukup untuk ditambahkan!');
            }
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $finalPrice,
                'img' => $product->img,
                'category' => $product->category->name ?? 'Umum',
                'quantity' => 1
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Jumlah produk diperbarui.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Keranjang dikosongkan.');
    }
}
