<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('components.wishlist', compact('wishlists'));
    }

    public function store($productId)
    {
        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

        return back()->with('success', 'Produk ditambahkan ke wishlist.');
    }

    public function destroy($wishlistId)
    {
        $wishlist = Wishlist::where('id', $wishlistId)->where('user_id', Auth::id())->firstOrFail();
        $wishlist->delete();

        return back()->with('success', 'Produk dihapus dari wishlist.');
    }
}
