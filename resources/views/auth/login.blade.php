<div class="min-h-screen flex">
    <!-- Kiri: Gambar penuh -->
    <div class="w-1/2 bg-cover bg-center" style="background-image: url('{{ asset('images/hero1.jpeg') }}');">
        <!-- Kosongkan konten, cukup background saja -->
    </div>

    <!-- Kanan: Form Login -->
    <div class="w-1/2 flex items-center justify-center bg-white px-8">
        <div class="w-full max-w-md">
            <h2 class="text-2xl font-bold text-primary mb-2">Dika Cell!</h2>
            <h3 class="text-xl font-bold mb-1">Selamat Datang!</h3>
            <p class="text-sm text-gray-600 mb-6">
                Silakan login dengan menggunakan akun yang telah anda daftarkan
            </p>

            <form action="" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block font-medium mb-1">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full border border-primary rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary" />
                </div>

                <div>
                    <label for="password" class="block font-medium mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full border border-primary rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary" />
                </div>

                <button type="submit"
                    class="w-full bg-primary text-white font-semibold py-2 rounded-md hover:bg-primary/90 transition">
                    Login
                </button>
            </form>
        </div>
    </div>
</div>
