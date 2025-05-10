<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function landing()
    {
        $categories = Category::with('products')->get();
        $products = Product::latest()->limit(3)->get();

        return view('pages.landing', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function getProduct($id)
    {
        $category = Category::findOrFail($id);

        return view('components.produk', [
            'category' => $category,
            'products' => $category->products
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('components.detailProduk', compact('product', 'relatedProducts'));
    }
}
