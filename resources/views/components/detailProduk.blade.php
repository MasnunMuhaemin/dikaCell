<div class="max-w-6xl mx-auto py-12 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">

        <!-- Gambar Produk -->
        <div class="relative w-full h-[400px] bg-primary rounded-xl shadow-lg flex justify-center items-center group">
            <img src="{{ asset('images/aksesoris.png') }}"
                alt="Casing iPhone 11 Pro"
                class="object-contain transition duration-300 ease-in-out max-h-full max-w-full">
        </div>

        <!-- Informasi Produk -->
        <div class="space-y-4">
            <h2 class="text-3xl font-bold text-gray-900">Casing iPhone 11 Pro</h2>

            <div class="flex items-center gap-3">
                <span class="text-red-600 text-2xl font-semibold">Rp 100.000</span>
                <span class="text-gray-400 line-through text-base">Rp 120.000</span>
            </div>

            <p class="text-sm text-gray-500">Kategori: <span class="text-gray-800 font-medium">Aksesoris HP</span></p>
            <p class="text-sm text-green-600 font-semibold">Stok tersedia</p>

            <p class="text-gray-700 text-base leading-relaxed">
                Casing premium untuk iPhone 11 Pro dengan desain elegan, anti slip dan tahan benturan.
                Cocok untuk kamu yang ingin tampil gaya sekaligus melindungi gadget-mu.
            </p>

            <div class="pt-6">
                <button
                    class="w-full md:w-auto bg-primary hover:bg-secondary text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-200">
                    Tambahkan ke Keranjang
                </button>
            </div>
        </div>
    </div>

    <!-- Produk Terkait -->
    <div class="mt-16">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Produk Terkait</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @for ($i = 0; $i < 4; $i++)
            <div class="bg-primary shadow rounded-lg overflow-hidden transition">
                <!-- Gambar Produk Terkait, memastikan gambar center di dalam flex container -->
                <div class="flex justify-center items-center mt-2 h-[200px]">
                    <img src="{{ asset('images/aksesoris.png') }}" alt="Produk Terkait" class="rounded-md mb-2 max-h-full object-contain">
                </div>
                <!-- Bagian Deskripsi Produk -->
                <div class="bg-gray-100 p-4">
                    <h4 class="text-sm font-medium text-gray-800">Casing iPhone 11 Pro</h4>
                    <p class="text-sm text-red-500 font-semibold">Rp 95.000</p>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
