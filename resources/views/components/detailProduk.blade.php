@extends('layouts.app')

<div class="max-w-6xl mx-auto py-24 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">

        <!-- Gambar Produk -->
        <div class="relative w-full h-[400px] bg-primary rounded-xl shadow-lg flex justify-center items-center group">
            <img src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->name }}"
                class="object-contain transition duration-300 ease-in-out max-h-full max-w-full">
        </div>

        <!-- Informasi Produk -->
        <div class="space-y-4">
            <h2 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h2> <!-- Nama Produk -->

            <div class="flex items-center gap-3">
                <span class="text-red-600 text-2xl font-semibold">Rp {{ number_format($product->price * 0.5, 2) }}</span> <!-- Harga diskon -->
                <span class="text-gray-400 line-through text-base">Rp {{ number_format($product->price, 2) }}</span> <!-- Harga asli -->
            </div>

            <p class="text-sm text-gray-500">Kategori: <span class="text-gray-800 font-medium">{{ $product->category->name }}</span></p> <!-- Kategori -->
            <p class="text-sm text-green-600 font-semibold">{{ $product->stock > 0 ? 'Stok tersedia' : 'Stok habis' }}</p> <!-- Stok -->

            <p class="text-gray-700 text-base leading-relaxed">
                {{ $product->description }} <!-- Deskripsi produk -->
            </p>

            <div class="pt-6">
                <button
                    class="w-full md:w-auto bg-primary hover:bg-secondary text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-200">
                    Tambahkan ke Keranjang
                </button>
            </div>

            <!-- Tombol Kembali ke Halaman Utama -->
            <div class="pt-6">
                <a href="{{ url('/') }}" class="w-full md:w-auto bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-3 rounded-lg shadow-md transition duration-200">
                    Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </div>

    <!-- Produk Terkait -->
    <div class="mt-16">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Produk Terkait</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($relatedProducts as $relatedProduct)
            <div class="bg-primary shadow rounded-lg overflow-hidden transition">
                <div class="flex justify-center items-center mt-2 h-[200px]">
                    <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="Produk Terkait" class="rounded-md mb-2 max-h-full object-contain">
                </div>
                <div class="bg-gray-100 p-4">
                    <h4 class="text-sm font-medium text-gray-800">{{ $relatedProduct->name }}</h4>
                    <p class="text-sm text-red-500 font-semibold">Rp {{ number_format($relatedProduct->price) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
