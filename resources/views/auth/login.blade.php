<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login || Customer</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png"/>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">
            <script src="{{ mix('js/app.js') }}" defer></script>
        @endif
</head>
<body>
    <div class="min-h-screen flex">
        <div class="w-1/2 bg-cover bg-center" style="background-image: url('{{ asset('images/hero1.jpeg') }}');">
        </div>
        <div class="w-1/2 flex items-center justify-center bg-white px-8">
            <div class="w-full max-w-md">
                <h2 class="text-2xl font-bold text-primary mb-2">Dika Cell!</h2>
                <h3 class="text-xl font-bold mb-1">Selamat Datang!</h3>
                <p class="text-sm text-gray-600 mb-6">
                    Silakan login dengan menggunakan akun yang telah anda daftarkan
                </p>
    
                <form action="{{ route('auth.loginVerify') }}" method="POST" class="space-y-4">
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
</body>
</html>

