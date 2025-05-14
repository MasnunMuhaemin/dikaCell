<section id="kategori" class="py-14">
  <div class="max-w-8xl mx-auto px-8 sm:px-10 lg:px-12">
    @foreach ($categories as $category)
      <div class="flex items-center justify-between mb-6 mt-10">
        <h2 class="text-xl font-bold underline">{{ $category->name }}</h2>
        <a href="{{ route('category.products', $category->id) }}" class="text-primary text-sm font-semibold flex items-center gap-1 hover:underline">
          Lihat Selengkapnya <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($category->products->take(4) as $product)
          <a href="{{ route('produk.show', $product->id) }}" class="block">
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
              <div class="relative bg-primary h-64 flex items-center justify-center">
                <img src="{{ asset('storage/' . ($product->img ?: 'default-image.png')) }}" alt="{{ $product->name }}" class="h-48">
                <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2 py-1 z-10">
                  {{ $product->discount }}%
                </div>
                <form id="wishlist" action="{{ route('wishlist.store', $product->id) }}" method="POST" class="absolute top-2 left-2 z-10">
                    @csrf
                    <button type="submit" class="text-pink-600 p-2 hover:text-pink-700">
                        <i class="fas fa-heart"></i>
                    </button>
                </form>
              </div>

              <div class="h-1 bg-red-500 w-full"></div>
              <div class="bg-gray-200 p-4">
                <div class="flex justify-between text-sm text-gray-700 mb-1">
                  <span class="line-through text-black">Rp. {{ number_format($product->price, 2) }}</span>
                  <span>
                    @if ($product->stock == 0)
                      <span class="text-red-500 text-sm">Stok Habis</span>
                    @else
                      Stok: {{ $product->stock }}
                    @endif
                  </span>
                </div>
                <div class="text-red-600 font-bold text-lg mb-1">
                  Rp. {{ number_format($product->price * (1 - $product->discount / 100), 2) }}
                </div>
                <div class="text-center font-medium text-black">{{ $product->name }}</div>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    @endforeach
  </div>
</section>

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
