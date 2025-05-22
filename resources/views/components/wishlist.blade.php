@extends('layouts.app')

@section('content')
<div class="container h-screen py-20">
    <div class="max-w-5xl mx-auto py-10 px-4">
        <h1 class="text-2xl font-bold mb-6">Wishlist Anda</h1>

        @forelse($wishlists as $wishlist)
            <div class="bg-white rounded-lg shadow-md p-4 mb-4 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . ($wishlist->product->img ?? 'default-image.png')) }}" 
                        alt="{{ $wishlist->product->name }}" 
                        class="w-20 h-20 object-cover rounded">

                    <div>
                        <p class="font-semibold text-lg">{{ $wishlist->product->name }}</p>
                        <p class="text-gray-600">Rp {{ number_format($wishlist->product->price, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="flex gap-2 items-center">
                    <form action="{{ route('cart.add', $wishlist->product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-primary hover:text-blue-400 py-1 px-3 rounded text-sm font-bold">
                            Tambah ke Keranjang
                        </button>
                    </form>

                    <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:text-red-800 font-semibold text-sm">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Belum ada produk dalam wishlist Anda.</p>
        @endforelse
    </div>
</div>
@endsection