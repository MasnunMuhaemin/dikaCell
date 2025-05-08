<nav class="bg-white container shadow fixed top-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center h-16 justify-between">
      
      <div class="text-xl font-extrabold text-black">
        DIKA CELL
      </div>
      
      <div class="flex items-center space-x-8 ml-auto">
        <a href="#tentang" class="text-black font-semibold px-4 py-2 block hover:bg-primary hover:text-white transition-all duration-200">
          TENTANG
        </a>
        <a href="#kategori" class="text-black font-semibold px-4 py-2 block hover:bg-primary hover:text-white transition-all duration-200">
          PRODUK
        </a>
        <a href="#kontak" class="text-black font-semibold px-4 py-2 block hover:bg-primary hover:text-white transition-all duration-200">
          KONTAK
        </a>
        
        @if (auth()->check())
          <a href="{{ route('auth.logout') }}" class="text-black font-semibold px-4 py-2 block hover:bg-primary hover:text-white transition-all duration-200">
            LOGOUT
          </a>
        @else
          <a href="{{ route('login') }}" class="text-black font-semibold px-4 py-2 block hover:bg-primary hover:text-white transition-all duration-200">
            LOGIN
          </a>
          <a href="{{ route('auth.register') }}" class="text-black font-semibold px-4 py-2 block hover:bg-primary hover:text-white transition-all duration-200">
            REGISTER
          </a>
        @endif
      </div>

      @if (auth()->check())
        <a href="#" class="relative text-black hover:text-primary transition ml-4">
          <i class="fas fa-shopping-cart text-2xl"></i>
          <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">3</span>
        </a>
      @endif

    </div>
  </div>
</nav>
