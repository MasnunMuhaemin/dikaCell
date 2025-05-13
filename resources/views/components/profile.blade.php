@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-24">
    <div class="bg-white border border-primary shadow rounded-lg p-6 mb-6 flex flex-col md:flex-row items-center md:items-start gap-6">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=128" class="w-24 h-24 rounded-full shadow-md" alt="Avatar">
        
        <div class="flex-1">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Nama Lengkap: {{ $user->name }}</h2>
            <p class="text-gray-600">Email: {{ $user->email }}</p>
            <p class="text-gray-600 mb-2">Alamat: {{ $user->alamat }}</p>

            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                @if ($user->badge === 'Platinum') badge-platinum
                @elseif ($user->badge === 'Gold') badge-gold
                @else badge-default
                @endif">
                {{ ucfirst($user->badge) }} Member
            </span>
        </div>
    </div>
    <div class="mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Riwayat Transaksi</h3>
    </div>

   <div class="space-y-6">
        @foreach ($payments as $payment)
            <div class="bg-white rounded-xl shadow-md p-6 mb-6 border border-primary">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4">
                    <div>
                        <p class="text-base text-gray-500">Dibayar pada: {{ $payment->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @if ($payment->payment_status === 'paid')
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">Sudah Dibayar</span>
                        @elseif ($payment->payment_status === 'pending')
                            <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full">Menunggu Pembayaran</span>
                        @endif
                        <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">
                            Status Pesanan: {{ ucfirst($payment->order->status) }}
                        </span>
                        <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full">
                            Pengiriman: {{ ucfirst($payment->order->shipment->shipping_status ?? 'Belum dikirim') }}
                        </span>
                    </div>
                </div>
                <hr class="border-t-2 border-primary my-4">
                <div class="divide-y divide-gray-200">
                    @foreach ($payment->order->orderItems as $item)
                        <div class="py-4">
                            <p class="font-semibold text-2xl text-gray-800">{{ $item->product->name ?? 'Produk tidak ditemukan' }}</p>
                            <p class="text-sm font-semibold text-gray-500">Jumlah Barang: {{ $item->quantity }} &nbsp;·&nbsp; Harga: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
                <hr class="border-t-2 border-primary my-4">
                <div class="mt-4 text-right">
                    <p class="text-sm font-semibold text-gray-700">Total: 
                        <span class="text-lg text-black">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
