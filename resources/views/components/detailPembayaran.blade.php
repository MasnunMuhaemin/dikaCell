@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Detail Pembayaran</h2>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-white shadow-md rounded p-4 mb-6">
        <h5 class="text-lg font-semibold mb-3">Produk di Keranjang</h5>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Nama Produk</th>
                        <th class="px-4 py-2 text-left">Jumlah</th>
                        <th class="px-4 py-2 text-left">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cart as $item)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $item['name'] ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item['quantity'] ?? 1 }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">Keranjang kosong.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="bg-white shadow-md rounded p-4">
        <h5 class="text-lg font-semibold mb-4">Form Pembayaran & Pengiriman</h5>
        <form action="{{ route('process.payment') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="orderId" value="{{ $order->id ?? '' }}">
            <div>
                <label for="payment_method" class="block font-medium text-sm">Metode Pembayaran</label>
                <select name="payment_method" id="payment_method" required class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                    <option value="">-- Pilih --</option>
                    <option value="transfer">Transfer Bank</option>
                    <option value="e-wallet">e-wallet</option>
                    <option value="cod">Cash on Delivery (COD)</option>
                </select>
            </div>
            <div>
                <label for="alamat_lengkap" class="block font-medium text-sm">Alamat Lengkap</label>
                <textarea name="alamat_lengkap" rows="2" required class="mt-1 block w-full border-gray-300 rounded shadow-sm"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block font-medium text-sm">Kota</label>
                    <input type="text" name="kota" required class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm">Kecamatan</label>
                    <input type="text" name="kecamatan" required class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm">Desa</label>
                    <input type="text" name="desa" required class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm">Kode Pos</label>
                    <input type="text" name="kode_pos" required class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                </div>
            </div>
            <div>
                <label class="block font-medium text-sm">Ongkos Kirim (Rp)</label>
                <input type="number" name="shipping_cost" required class="mt-1 block w-full border-gray-300 rounded shadow-sm">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                    Bayar Sekarang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
