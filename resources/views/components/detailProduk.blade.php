@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-24 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
        <div class="relative w-full h-[400px] bg-primary rounded-xl shadow-lg flex justify-center items-center group">
            <form id="wish" action="{{ route('wishlist.store', $product->id) }}" method="POST" class="absolute top-4 left-4 z-10">
                @csrf
                <button type="submit" class="text-pink-600 p-2 hover:text-pink-700">
                    <i class="fas fa-heart"></i>
                </button>
            </form>
            <img src="{{ asset('storage/' . ($product->img ?: 'default-image.png')) }}" alt="{{ $product->name }}"
                class="object-contain transition duration-300 ease-in-out max-h-full max-w-full">
        </div>
        
        <div class="space-y-4">
            <h2 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h2> 

            <div class="flex items-center gap-3">
                <span class="text-red-600 text-2xl font-semibold">Rp {{ number_format($product->price * (1 - $product->discount / 100), 2) }}</span>
                <span class="text-gray-400 line-through text-base">Rp {{ number_format($product->price, 2) }}</span> 
            </div>

            <p class="text-sm text-gray-500">Kategori: <span class="text-gray-800 font-medium">{{ $product->category->name }}</span></p> 
            <p class="text-sm text-green-600 font-semibold">{{ $product->stock > 0 ? 'Stok tersedia' : 'Stok habis' }}</p> 

            <p class="text-gray-700 text-base leading-relaxed">
                {{ $product->description }}
            </p>

            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" 
                    class="w-full md:w-auto bg-primary hover:bg-blue-500 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-200">
                    Tambahkan ke Keranjang
                </button>
            </form>          
        </div>
    </div>
    <div class="mt-16">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Produk Terkait</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
            @foreach($relatedProducts as $relatedProduct)
            <div class="relative bg-primary shadow rounded-lg overflow-hidden transition">
                <form id="wishlist" action="{{ route('wishlist.store', $relatedProduct->id) }}" method="POST" class="absolute top-2 left-2 z-10">
                    @csrf
                    <button type="submit" class="text-pink-600 p-2 hover:text-pink-700">
                        <i class="fas fa-heart"></i>
                    </button>
                </form>

                <div class="flex justify-center items-center mt-2 h-[200px]">
                    <img src="{{ asset('storage/' . ($relatedProduct->img ?: 'default-image.png')) }}" 
                         alt="Produk Terkait" class="rounded-md mb-2 max-h-full object-contain">
                </div>
                <div class="bg-gray-100 p-4">
                    <h4 class="text-sm font-medium text-gray-800">{{ $relatedProduct->name }}</h4>
                    <p class="text-sm text-red-500 font-semibold">Rp {{ number_format($relatedProduct->price * (1 - $relatedProduct->discount / 100), 2) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.getElementById('wish').addEventListener('submit', function(event) {
        @auth
            return true;
        @else
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Anda belum login!',
                text: 'Silakan login terlebih dahulu untuk menambahkan produk ke wishlist.',
                showCancelButton: true,
                confirmButtonText: 'Login Sekarang',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('login') }}';
                }
            });
        @endauth
    });
</script>
<script>
    document.getElementById('wishlist').addEventListener('submit', function(event) {
        @auth
            return true;
        @else
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Anda belum login!',
                text: 'Silakan login terlebih dahulu untuk menambahkan produk ke wishlist.',
                showCancelButton: true,
                confirmButtonText: 'Login Sekarang',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('login') }}';
                }
            });
        @endauth
    });
</script>
@endsection
