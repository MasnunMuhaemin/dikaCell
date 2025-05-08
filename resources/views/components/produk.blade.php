@extends('layouts.app')
    <section id="kategori-detail" class="py-24">
        <div class="max-w-8xl mx-auto px-8 sm:px-10 lg:px-12">
          <h2 class="text-xl font-bold underline mb-4">{{ $category->name }}</h2>
      
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
            <a href="{{ route('produk.show', $product->id) }}" class="block">
              <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Image with Diskon -->
                <div class="relative bg-primary h-64 flex items-center justify-center">
                  <img src="{{ asset('images/aksesoris.png') }}" alt="Produk {{ $product->name }}" class="h-48">
                  <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2 py-1">
                    50%
                  </div>
                </div>
      
                <div class="h-1 bg-red-500 w-full"></div>
      
                <!-- Detail Produk -->
                <div class="bg-gray-200 p-4">
                  <div class="flex justify-between text-sm text-gray-700 mb-1">
                    <span class="line-through text-black">Rp. {{ number_format($product->price, 2) }}</span>
                    <span>Stok: {{ $product->stock }}</span>
                  </div>
                  <div class="text-red-600 font-bold text-lg mb-1">Rp. {{ number_format($product->price * 0.5, 2) }}</div>
                  <div class="text-center font-medium text-black">{{ $product->name }}</div>
                </div>
              </div>
            </a>  
            @endforeach
          </div>
        </div>
      </section>
  