<nav class="bg-white shadow fixed top-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      <div class="text-xl font-extrabold text-black">
        DIKA CELL
      </div>
      <div class="hidden lg:flex items-center space-x-6">
        <a href="/#tentang" class="text-black font-semibold hover:text-primary">TENTANG</a>
        <a href="/#kategori" class="text-black font-semibold hover:text-primary">PRODUK</a>
        <a href="/#kontak" class="text-black font-semibold hover:text-primary">KONTAK</a>

        @if (auth()->check())
          <a href="{{ route('auth.logout') }}" class="text-black font-semibold hover:text-primary">LOGOUT</a>
        @else
          <a href="{{ route('login') }}" class="text-black font-semibold hover:text-primary">LOGIN</a>
          <a href="{{ route('auth.register') }}" class="text-black font-semibold hover:text-primary">REGISTER</a>
        @endif

        @php
            $cart = session('cart', []);
            $cartCount = collect($cart)->sum('quantity');
        @endphp

        @if (auth()->check())
          <a href="{{ route('cart.index') }}" class="relative text-black hover:text-primary">
            <i class="fas fa-shopping-cart text-2xl"></i>
            @if ($cartCount > 0)
              <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">{{ $cartCount }}</span>
            @endif
          </a>
          <a href="{{ route('profile') }}" class="text-black hover:text-primary">
            <i class="fas fa-user-circle text-2xl"></i>
          </a>
        @endif
      </div>
      <div class="lg:hidden z-[999] relative">
        <button id="menuToggle" class="text-2xl text-black focus:outline-none">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
  </div>
</nav>
<div id="sidebar" class="fixed top-0 right-0 h-full w-full bg-white transform translate-x-full transition-transform duration-300 z-50 lg:hidden">
  <div class="flex justify-between items-center p-4 border-b">
    <span class="text-xl font-bold">Menu</span>
    <button id="closeSidebar" class="text-xl">
      <i class="fas fa-times"></i>
    </button>
  </div>
  <div class="flex flex-col items-center justify-start p-4 space-y-6 pt-6">
    <a href="#tentang" class="text-black font-semibold hover:text-primary">TENTANG</a>
    <a href="#kategori" class="text-black font-semibold hover:text-primary">PRODUK</a>
    <a href="#kontak" class="text-black font-semibold hover:text-primary">KONTAK</a>

    @if (auth()->check())
      <a href="{{ route('auth.logout') }}" class="text-black font-semibold hover:text-primary">LOGOUT</a>
    @else
      <a href="{{ route('login') }}" class="text-black font-semibold hover:text-primary">LOGIN</a>
      <a href="{{ route('auth.register') }}" class="text-black font-semibold hover:text-primary">REGISTER</a>
    @endif

    @if (auth()->check())
      <a href="{{ route('cart.index') }}" class="text-black font-semibold hover:text-primary flex items-center space-x-2">
        <span>KERANJANG</span>
        @if ($cartCount > 0)
          <span class="bg-red-500 text-white text-xs rounded-full px-2">{{ $cartCount }}</span>
        @endif
      </a>
      <a href="{{ route('profile') }}" class="text-black font-semibold hover:text-primary flex items-center space-x-2">
        <span>PROFIL</span>
      </a>
    @endif
  </div>
</div>
<div id="overlay" class="hidden fixed inset-0 bg-black opacity-30 z-40 lg:hidden"></div>
<script>
  const menuToggle = document.getElementById('menuToggle');
  const sidebar = document.getElementById('sidebar');
  const closeSidebar = document.getElementById('closeSidebar');
  const overlay = document.getElementById('overlay');

  menuToggle.addEventListener('click', () => {
    sidebar.classList.remove('translate-x-full');
    overlay.classList.remove('hidden');
  });

  const closeSidebarFn = () => {
    sidebar.classList.add('translate-x-full');
    overlay.classList.add('hidden');
  };

  closeSidebar.addEventListener('click', closeSidebarFn);
  overlay.addEventListener('click', closeSidebarFn);
</script>
