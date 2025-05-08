<section id="kategori" class="py-14">
  <div class="max-w-8xl mx-auto px-8 sm:px-10 lg:px-12">
    
    @foreach ($category as $cat)
      <!-- Header Section -->
      <div class="flex items-center justify-between mb-6 mt-10">
        <h2 class="text-xl font-bold underline">{{ $cat->name }}</h2>
        <a href="{{ route('category.products', $cat->id) }}" class="text-primary text-sm font-semibold flex items-center gap-1 hover:underline">
          Lihat Selengkapnya <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <!-- Product Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($cat->products->take(4) as $product)
          <a href="{{ route('produk.show', $product->id) }}" class="block">
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
              <!-- Image with Diskon -->
              <div class="relative bg-primary h-64 flex items-center justify-center">
                <img src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->name }}"   class="h-48">
                <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2 py-1">
                  50%
                </div>
              </div>

              <div class="h-1 bg-red-500 w-full"></div>

              <!-- Detail Produk -->
              <div class="bg-gray-200 p-4">
                <div class="flex justify-between text-sm text-gray-700 mb-1">
                  <span class="line-through text-black">Rp. {{ number_format($product->price, 2) }}</span>
                  <span>Stok: {{ $product->stock }}</span>
                </div>
                <div class="text-red-600 font-bold text-lg mb-1">Rp. {{ number_format($product->price * 0.5, 2) }}</div>
                <div class="text-center font-medium text-black">{{ $product->name }}</div>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    @endforeach
  </div>
</section>
