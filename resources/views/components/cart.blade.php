@extends('layouts.app')

@section('content')
<div class="container py-20 px-4 sm:px-6 md:px-8">
    <!-- Judul Halaman -->
    <div class="text-center mb-10">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-800">🛒 Keranjang Belanja</h2>
        <p class="text-sm text-gray-500 mt-2">Kelola produk pilihanmu sebelum lanjut ke pembayaran.</p>
    </div>

    <div class="bg-white border border-primary shadow-xl rounded-lg p-4 sm:p-6 space-y-6">
        @php $total = 0; @endphp

        @forelse($cart as $id => $item)
        <div class="flex flex-col sm:flex-row sm:items-start md:items-center justify-between border-b border-secondary pb-6 gap-4 sm:gap-6">
            <div class="flex items-start gap-4 w-full sm:w-2/3">
                <img src="{{ asset('storage/' . $item['img']) }}" alt="{{ $item['name'] }}"
                     class="w-24 h-24 sm:w-28 sm:h-28 object-cover rounded-lg shadow">
                <div class="flex flex-col">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">{{ $item['name'] }}</h3>
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mt-1 w-fit">
                        {{ $item['category'] ?? 'Umum' }}
                    </span>
                    <div class="mt-2 text-red-600 text-lg sm:text-xl font-bold">
                        Rp {{ number_format($item['price']) }}
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-4">
                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center space-x-2">
                    @csrf
                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                           class="w-16 p-2 border rounded-lg text-center shadow-sm">
                    <button type="submit"
                            class="text-blue-600 hover:underline text-sm font-medium">Update</button>
                </form>
                <a href="{{ route('cart.remove', $id) }}"
                   class="text-red-500 hover:underline text-sm font-medium">Hapus</a>
            </div>
        </div>
        @php $total += $item['price'] * $item['quantity']; @endphp
        @empty
        <p class="text-center text-gray-500">Keranjang kamu masih kosong. Yuk belanja dulu!</p>
        @endforelse
    </div>

    @if(count($cart) > 0)
    <!-- Total Harga -->
    <div class="mt-8 bg-gray-50 border border-primary p-4 sm:p-6 rounded-lg shadow flex flex-col sm:flex-row justify-between items-center text-base sm:text-lg gap-2">
        <span class="font-semibold text-gray-700">Total Belanja:</span>
        <span class="text-red-600 font-bold text-xl sm:text-2xl">Rp {{ number_format($total) }}</span>
    </div>

    <!-- Tombol Aksi -->
    <div class="mt-6 flex flex-col md:flex-row gap-4 justify-between">
        <a href="{{ route('checkout.payment', ['orderId' => $order->id ?? 1]) }}"
           class="w-full md:w-auto bg-primary/75 hover:bg-primary text-white font-semibold py-3 px-6 rounded-lg shadow transition duration-300 text-center">
            Lanjut ke Pembayaran
        </a>
        <a href="{{ url('/') }}"
           class="w-full md:w-auto bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-3 px-6 rounded-lg shadow transition duration-300 text-center">
             Lanjut Belanja
        </a>
    </div>
    @endif

    <!-- Tombol Kembali -->
    <div class="mt-10 text-center">
        <a href="{{ url('/') }}"
           class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-5 rounded-full text-sm font-medium shadow">
            ← Kembali ke Halaman Utama
        </a>
    </div>
</div>
@endsection
