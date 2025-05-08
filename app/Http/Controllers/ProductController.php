<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function landing()
    {
        $allProducts = Product::limit(3)->get();
        $category = Category::with('products')->get();
        
        return view('pages.landing', [
            'product' => $allProducts,
            'category' => $category
        ]);
    }

    public function getProduct($id)
    {
        $category = Category::with('products')->findOrFail($id); 

        return view('components.produk', [
            'category' => $category,
            'products' => $category->products 
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Mengambil produk terkait, bisa menggunakan relasi atau kriteria lain
        $relatedProducts = Product::where('category_id', $product->category_id)
                                  ->where('id', '!=', $product->id)
                                  ->take(4)
                                  ->get();

        // Mengirim data ke view dengan compact
        return view('components.detailProduk', compact('product', 'relatedProducts'));
    }
}
