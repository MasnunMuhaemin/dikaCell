<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register || Customer</title>
</head>
<body>
    <div class="min-h-screen flex">
        <!-- Kiri: Gambar penuh -->
        <div class="w-1/2 bg-cover bg-center" style="background-image: url('{{ asset('images/hero2.jpeg') }}');">
            <!-- Kosongkan konten, hanya background -->
        </div>
    
        <!-- Kanan: Form Registrasi -->
        <div class="w-1/2 flex items-center justify-center bg-white px-8">
            <div class="w-full max-w-md">
                <h2 class="text-2xl font-bold text-primary mb-2">Dika Cell!</h2>
                <h3 class="text-xl font-bold mb-1">Selamat Datang!</h3>
                <p class="text-sm text-gray-600 mb-6">
                    Daftarlah dengan mudah dan cepat untuk mengakses segala keuntungan!
                </p>
    
                <form action="{{ route('auth.registerVerify') }}" method="POST" class="space-y-4">
                    @csrf
    
                    <div>
                        <label for="name" class="block font-medium mb-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" required
                            class="w-full border border-primary rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary" />
                    </div>
    
                    <div>
                        <label for="email" class="block font-medium mb-1">Email</label>
                        <input type="email" name="email" id="email" required
                            class="w-full border border-primary rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary" />
                    </div>
    
                    <div>
                        <label for="alamat" class="block font-medium mb-1">Alamat</label>
                        <input type="text" name="alamat" id="alamat" required
                            class="w-full border border-primary rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary" />
                    </div>
    
                    <div>
                        <label for="phone" class="block font-medium mb-1">No Hp</label>
                        <input type="text" name="phone" id="phone" required
                            class="w-full border border-primary rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary" />
                    </div>
    
                    <div>
                        <label for="password" class="block font-medium mb-1">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full border border-primary rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary" />
                    </div>
    
                    <button type="submit"
                        class="w-full bg-primary text-white font-semibold py-2 rounded-md hover:bg-primary/90 transition">
                        Daftar Akun
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
