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
        @php
            $badge = Auth::user()->badge ?? 'Bronze';
            $diskon = 0;

            if ($badge === 'Gold') {
                $diskon = 10;
            } elseif ($badge === 'Platinum') {
                $diskon = 15;
            }
        @endphp

        <p class="mb-4 text-sm text-gray-700">
            Anda mendapatkan diskon sebesar: 
            <strong class="text-green-600">{{ $diskon }}%</strong> 
            karena Anda memiliki badge 
            <strong class="capitalize">{{ ucfirst($badge) }}</strong>.
        </p>

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
                    @php
                        $discountPercentage = $diskon;
                        $totalOriginal = 0;
                        $totalDiscount = 0;
                        $totalSubtotal = 0;
                    @endphp

                    @forelse($cart as $item)
                        @php
                            $price = $item['price'] ?? 0;
                            $qty = $item['quantity'] ?? 1;
                            $discountedPrice = $price * (1 - $discountPercentage / 100);
                            $itemDiscount = ($price - $discountedPrice) * $qty;

                            $totalOriginal += $price * $qty;
                            $totalDiscount += $itemDiscount;
                            $totalSubtotal += $discountedPrice * $qty;
                        @endphp
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $item['name'] ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $qty }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($price, 0, ',', '.') }}</td>
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
    <div class="bg-gray-50 p-4 rounded mb-6">
        <h5 class="font-semibold text-lg mb-3">Ringkasan Pembayaran</h5>
        <ul class="text-sm space-y-1">
            <li class="flex justify-between">
                <span>Total Harga Asli:</span>
                <span>Rp {{ number_format($totalOriginal, 0, ',', '.') }}</span>
            </li>
            <li class="flex justify-between">
                <span>Diskon Tambahan ({{ $discountPercentage }}% - {{ ucfirst($badge) }}):</span>
                <span>- Rp {{ number_format($totalDiscount, 0, ',', '.') }}</span>
            </li>
            <li class="flex justify-between font-semibold">
                <span>Subtotal Setelah Diskon:</span>
                <span id="subtotal-setelah-diskon">Rp {{ number_format($totalSubtotal, 0, ',', '.') }}</span>
            </li>
            <li class="flex justify-between">
                <span>Ongkos Kirim:</span>
                <span id="ongkir-display">Rp 0</span>
            </li>
            <li class="flex justify-between text-lg font-bold border-t pt-2">
                <span>Total Bayar:</span>
                <span id="total-bayar-display">Rp {{ number_format($totalSubtotal, 0, ',', '.') }}</span>
            </li>
        </ul>
    </div>
    <div class="bg-white shadow-md rounded p-4">
        <h5 class="text-lg font-semibold mb-4">Form Pembayaran & Pengiriman</h5>
        <form action="{{ route('process.payment') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="orderId" value="{{ $order->id ?? '' }}">
            <input type="hidden" name="total_price" value="{{ $totalSubtotal }}">
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
                <textarea name="alamat_lengkap" rows="2" required class="mt-1 block w-full border border-primary rounded shadow-sm"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block font-medium text-sm">Kota</label>
                    <input type="text" name="kota" required class="mt-1 block w-full border border-primary rounded shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm">Kecamatan</label>
                    <input type="text" name="kecamatan" required class="mt-1 block w-full border border-primary rounded shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm">Desa</label>
                    <input type="text" name="desa" required class="mt-1 block w-full border border-primary rounded shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm">Kode Pos</label>
                    <input type="text" name="kode_pos" required class="mt-1 block w-full border border-primary rounded shadow-sm">
                </div>
            </div>
            <div>
                <label class="block font-medium text-sm">Ongkos Kirim (Rp)</label>
                <input type="number" name="shipping_cost" required class="mt-1 block w-full border border-primary rounded shadow-sm" id="ongkir-input">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-primary hover:bg-blue-400 text-white font-semibold py-2 px-4 rounded">
                    Bayar Sekarang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ongkirInput = document.getElementById('ongkir-input');
        const ongkirDisplay = document.getElementById('ongkir-display');
        const totalBayarDisplay = document.getElementById('total-bayar-display');
        const subtotalDiskon = {{ $totalSubtotal }};

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        }

        ongkirInput.addEventListener('input', function () {
            const ongkir = parseInt(this.value) || 0;
            const total = subtotalDiskon + ongkir;

            ongkirDisplay.textContent = formatRupiah(ongkir);
            totalBayarDisplay.textContent = formatRupiah(total);
        });
    });
</script>
@endpush
