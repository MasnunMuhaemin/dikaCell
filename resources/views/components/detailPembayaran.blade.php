<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-md mt-10">
    <h2 class="text-2xl font-bold text-primary mb-6">Form Pembayaran & Pemilihan Jasa Pengiriman</h2>
    <form action="#" method="POST" class="space-y-6">
        <!-- Pemilihan Jasa Pengiriman -->
        <div>
            <label for="shipping_service" class="block text-gray-500 mb-2">Pilih Jasa Pengiriman</label>
            <select id="shipping_service" name="shipping_service" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                <option value="jne">JNE - REG</option>
                <option value="jnt">JNT - Regular</option>
                <option value="tiki">TIKI - ONS</option>
            </select>
        </div>

        <!-- Pembayaran -->
        <div>
            <label for="payment_method" class="block text-gray-500 mb-2">Metode Pembayaran</label>
            <select id="payment_method" name="payment_method" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                <option value="bca">Transfer Bank (BCA)</option>
                <option value="mandiri">Transfer Bank (Mandiri)</option>
                <option value="gopay">GoPay</option>
            </select>
        </div>

        <!-- Button Submit -->
        <div>
            <button type="submit" class="w-full bg-primary text-white py-2 px-4 rounded-md font-semibold hover:bg-primary-dark">
                Konfirmasi Pembayaran
            </button>
        </div>
    </form>

    <!-- Informasi Pembayaran -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 mt-6">
        <div>
            <p class="text-gray-500">Nama Pemesan</p>
            <p class="font-semibold text-black">John Doe</p>
        </div>
        <div>
            <p class="text-gray-500">Tanggal Pembayaran</p>
            <p class="font-semibold text-black">6 Mei 2025</p>
        </div>
        <div>
            <p class="text-gray-500">Metode Pembayaran</p>
            <p class="font-semibold text-black">Transfer Bank (BCA)</p>
        </div>
        <div>
            <p class="text-gray-500">Status</p>
            <span class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                Lunas
            </span>
        </div>
    </div>

    <!-- Rincian Produk -->
    <div class="border-t pt-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Rincian Produk</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-sm text-gray-600">
                        <th class="py-2 px-4 border-b">Produk</th>
                        <th class="py-2 px-4 border-b">Qty</th>
                        <th class="py-2 px-4 border-b">Harga Satuan</th>
                        <th class="py-2 px-4 border-b">Total</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b">
                        <td class="py-2 px-4">Charger Samsung Original</td>
                        <td class="py-2 px-4">2</td>
                        <td class="py-2 px-4">Rp75.000</td>
                        <td class="py-2 px-4">Rp150.000</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 px-4">Tempered Glass Xiaomi</td>
                        <td class="py-2 px-4">1</td>
                        <td class="py-2 px-4">Rp30.000</td>
                        <td class="py-2 px-4">Rp30.000</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="py-3 px-4 text-right font-semibold">Subtotal</td>
                        <td class="py-3 px-4 font-semibold">Rp180.000</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="py-2 px-4 text-right font-semibold">Ongkir</td>
                        <td class="py-2 px-4 font-semibold">Rp20.000</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="py-3 px-4 text-right text-lg font-bold">Total Pembayaran</td>
                        <td class="py-3 px-4 text-lg font-bold text-primary">Rp200.000</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Informasi Transaksi -->
    <div class="border-t pt-6 mt-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Informasi Transaksi</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-gray-500">ID Transaksi</p>
                <p class="font-semibold text-black">TRX20250506001</p>
            </div>
            <div>
                <p class="text-gray-500">Tanggal Transaksi</p>
                <p class="font-semibold text-black">6 Mei 2025</p>
            </div>
            <div>
                <p class="text-gray-500">Jasa Pengiriman</p>
                <p class="font-semibold text-black">JNE - REG</p>
            </div>
            <div>
                <p class="text-gray-500">Nomor Resi</p>
                <p class="font-semibold text-black">JNE1234567890</p>
            </div>
            <div>
                <p class="text-gray-500">Alamat Pengiriman</p>
                <p class="font-semibold text-black">
                    Jl. Merdeka No.123, Bandung, Jawa Barat
                </p>
            </div>
        </div>
    </div>
</div>
