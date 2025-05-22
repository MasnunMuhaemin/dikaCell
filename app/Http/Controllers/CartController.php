<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('components.cart', compact('cart'));
    }


    public function add(Request $request, $id)
{
    if (!Auth::check()) {
        return redirect()->back()->with('error', 'Anda harus login untuk menambahkan produk ke keranjang.');
    }

    $product = Product::findOrFail($id);

    if ($product->stock <= 0) {
        return redirect()->back()->with('error', 'Produk ini sudah habis, tidak dapat ditambahkan ke keranjang!');
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
            'price' => $product->price - ($product->price * $product->discount / 100),
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
