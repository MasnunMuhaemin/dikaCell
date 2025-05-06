<section class="py-14">
  <div class="max-w-8xl mx-auto px-8 sm:px-10 lg:px-12"> <!-- Memperlebar padding kanan dan kiri -->
    
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-xl font-bold underline">Aksesoris</h2>
      <a href="#" class="text-primary text-sm font-semibold flex items-center gap-1 hover:underline">
        Lihat Selengkapnya <i class="fas fa-arrow-right"></i>
      </a>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach (range(1, 4) as $i)
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        
        <!-- Image with Diskon -->
        <div class="relative bg-primary h-64 flex items-center justify-center">
          <img src="{{ asset('images/aksesoris.png') }}" alt="Produk {{ $i }}" class="h-48">
          <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2 py-1">
            50%
          </div>
        </div>

      <!-- Garis merah sebagai sekat -->
      <div class="h-1 bg-red-500 w-full"></div>
      
        <!-- Detail Produk -->
        <div class="bg-gray-200 p-4">
          <div class="flex justify-between text-sm text-gray-700 mb-1">
            <span class="line-through text-black">Rp. 300.000</span>
            <span>Stok: 100</span>
          </div>
          <div class="text-red-600 font-bold text-lg mb-1">Rp. 200.000</div>
          <div class="text-center font-medium text-black">Casing Iphone 11 Pro</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
