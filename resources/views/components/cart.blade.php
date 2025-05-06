<div class="max-w-6xl mx-auto py-12 px-4">
    <!-- Judul Halaman Keranjang -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-semibold text-gray-800">Keranjang Belanja Anda</h2>
        <p class="text-sm text-gray-500">Berikut adalah produk yang telah Anda pilih. Anda dapat melanjutkan ke pembayaran atau menghapus item.</p>
    </div>

    <!-- Daftar Produk dalam Keranjang -->
    <div class="bg-white shadow-lg rounded-lg p-6 space-y-6">
        <!-- Item 1 -->
        <div class="flex items-center justify-between border-b pb-4">
            <div class="flex items-center space-x-4">
                <!-- Gambar Produk -->
                <img src="{{ asset('images/aksesoris.png') }}" alt="Casing iPhone 11 Pro" class="w-32 h-32 object-contain rounded-lg">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Casing iPhone 11 Pro</h3>
                    <p class="text-sm text-gray-600">Kategori: Aksesoris HP</p>
                    <!-- Harga dan Diskon -->
                    <div class="flex items-center gap-3">
                        <span class="text-red-600 text-lg font-semibold">Rp 100.000</span>
                        <span class="text-gray-400 line-through text-base">Rp 120.000</span>
                        <span class="text-green-600 text-sm font-semibold">-17%</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <input type="number" value="1" min="1" class="w-16 p-2 border rounded-lg text-center">
                <button class="text-red-600 hover:text-red-800">Hapus</button>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="flex items-center justify-between border-b pb-4">
            <div class="flex items-center space-x-4">
                <!-- Gambar Produk -->
                <img src="{{ asset('images/aksesoris.png') }}" alt="Produk Lain" class="w-32 h-32 object-contain rounded-lg">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Casing Samsung Galaxy</h3>
                    <p class="text-sm text-gray-600">Kategori: Aksesoris HP</p>
                    <!-- Harga dan Diskon -->
                    <div class="flex items-center gap-3">
                        <span class="text-red-600 text-lg font-semibold">Rp 85.000</span>
                        <span class="text-gray-400 line-through text-base">Rp 100.000</span>
                        <span class="text-green-600 text-sm font-semibold">-15%</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <input type="number" value="1" min="1" class="w-16 p-2 border rounded-lg text-center">
                <button class="text-red-600 hover:text-red-800">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Total Harga -->
    <div class="mt-8 bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between text-lg font-semibold text-gray-800">
            <span>Total Harga:</span>
            <span class="text-red-600">Rp 185.000</span>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="mt-6 flex justify-between items-center">
        <button class="w-full md:w-auto bg-primary hover:bg-secondary text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-200">
            Lanjutkan ke Pembayaran
        </button>
        <button class="w-full md:w-auto bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-3 px-6 rounded-lg shadow-md transition duration-200">
            Lanjut Belanja
        </button>
    </div>
</div>
