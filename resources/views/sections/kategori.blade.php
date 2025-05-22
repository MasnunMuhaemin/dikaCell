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
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow min-h-[370px] flex flex-col relative">
              <div class="relative bg-primary h-64 flex items-center justify-center">
                <img src="{{ asset('storage/' . ($product->img ?: 'default-image.png')) }}" alt="{{ $product->name }}" class="h-48">
                
                @if ($product->discount > 0)
                    <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2 py-1 z-10">
                        {{ $product->discount }}%
                    </div>
                @endif

                <form id="wishlist" action="{{ route('wishlist.store', $product->id) }}" method="POST" class="absolute top-2 left-2 z-10">
                    @csrf
                    <button type="submit" class="text-pink-600 p-2 hover:text-pink-700">
                        <i class="fas fa-heart"></i>
                    </button>
                </form>
              </div>

              <div class="h-1 bg-red-500 w-full relative">
                <div class="absolute bottom-[-30px] right-2 bg-gray-200 text-gray-800 text-xs font-bold rounded-full px-2 py-1 z-10">
                    @if ($product->stock == 0)
                        <span class="text-red-500">Stok Habis</span>
                    @else
                        Stok: {{ $product->stock }}
                    @endif
                </div>
              </div>

              <div class="bg-gray-200 p-4 flex flex-col justify-between min-h-[130px]">
                @if ($product->discount > 0)
                    <div class="flex flex-col">
                        <span class="line-through text-sm text-black">
                            Rp. {{ number_format($product->price, 2) }}
                        </span>
                        <span class="text-red-600 font-bold text-lg">
                            Rp. {{ number_format($product->price * (1 - $product->discount / 100), 2) }}
                        </span>
                    </div>
                @else
                    <div class="text-black font-bold text-lg">
                        Rp. {{ number_format($product->price, 2) }}
                    </div>
                @endif

                <div class="text-center font-medium text-black">
                    {{ $product->name }}
                </div>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    @endforeach
  </div>
</section>