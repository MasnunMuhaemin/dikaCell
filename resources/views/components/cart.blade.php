@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-40 px-4">
    <!-- Judul Halaman Keranjang -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-semibold text-gray-800">Keranjang Belanja Anda</h2>
        <p class="text-sm text-gray-500">Berikut adalah produk yang telah Anda pilih. Anda dapat melanjutkan ke pembayaran atau menghapus item.</p>
    </div>

    <!-- Daftar Produk dalam Keranjang -->
    <div class="bg-white shadow-lg rounded-lg p-6 space-y-6">
        @php $total = 0; @endphp

        @forelse($cart as $id => $item)
        <div class="flex items-center justify-between border-b pb-4">
            <div class="flex items-center space-x-4">
                <!-- Gambar Produk -->
                <img src="{{ asset('storage/' . $item['img']) }}" alt="{{ $item['name'] }}" class="w-32 h-32 object-contain rounded-lg">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ $item['name'] }}</h3>
                    <p class="text-sm text-gray-600">Kategori: {{ $item['category'] ?? 'Umum' }}</p>
                    <div class="flex items-center gap-3">
                        <span class="text-red-600 text-lg font-semibold">Rp {{ number_format($item['price']) }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <form action="{{ route('cart.update', $id) }}" method="POST">
                    @csrf
                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 p-2 border rounded-lg text-center">
                    <button class="text-blue-600 hover:text-blue-800 ml-2">Update</button>
                </form>
                <a href="{{ route('cart.remove', $id) }}" class="text-red-600 hover:text-red-800">Hapus</a>
            </div>
        </div>
        @php $total += $item['price'] * $item['quantity']; @endphp
        @empty
        <p class="text-center text-gray-500">Keranjang kamu masih kosong.</p>
        @endforelse
    </div>

    @if(count($cart) > 0)
    <!-- Total Harga -->
    <div class="mt-8 bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between text-lg font-semibold text-gray-800">
            <span>Total Harga:</span>
            <span class="text-red-600">Rp {{ number_format($total) }}</span>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="mt-6 flex justify-between items-center gap-3 flex-col md:flex-row">
        <a href="{{ route('checkout.index') }}" class="btn btn-primary">
            Lanjutkan ke Pembayaran
        </a>               
        <a href="{{ url('/') }}" class="w-full md:w-auto bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-3 px-6 rounded-lg shadow-md transition duration-200 text-center">
            Lanjut Belanja
        </a>
    </div>
    @endif

    <!-- Tombol Kembali ke Halaman Utama -->
    <div class="mt-8 text-center">
        <a href="{{ url('/') }}" class="w-full md:w-auto bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg shadow-md transition duration-200">
            Kembali ke Halaman Utama
        </a>
    </div>
</div>
@endsection
