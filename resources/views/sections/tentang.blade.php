<section id="tentang" class="container py-16">
  <div class="max-w-8xl mx-auto px-8 sm:px-10 lg:px-12">
      <div class="grid md:grid-cols-2 gap-12 items-center">
      
          <!-- Kiri: Teks -->
          <div>
              <h4 class="text-2xl font-bold text-primary uppercase mb-2">
                  Tentang 
                  <span class="text-black">Kami</span>
              </h4>
              <h2 class="text-3xl sm:text-4xl font-bold text-black mb-4">
                  Lengkapi Kebutuhan HP-mu di <span class="text-primary">dikaCell!</span>
              </h2>
              <p class="text-black mb-6">
                  Aksesoris, sparepart, dan tools HP lengkap dan berkualitas. Belanja mudah, cepat, dan terpercaya hanya di dikaCell!
              </p>
              <a href="#kategori" class="inline-block px-6 py-3 bg-primary text-white font-semibold rounded-full shadow hover:bg-primary transition">
                  Pesan Sekarang!
              </a>
          </div>

          <!-- Kanan: Gambar tumpuk -->
          <div class="relative flex h-[350px] ml-16"> <!-- Tambahkan ml-16 untuk memberi margin kiri -->
              <div class="w-60 h-80 rounded-xl overflow-hidden absolute top-16 left-28 z-20"> <!-- Sesuaikan left-28 untuk gambar pertama -->
                  <img src="{{ asset('images/hero1.jpeg') }}" alt="Gambar 1" class="w-full h-full object-cover">
              </div>
              <div class="w-60 h-80 rounded-xl overflow-hidden absolute top-36 left-48 z-10"> <!-- Sesuaikan left-48 untuk gambar kedua -->
                  <img src="{{ asset('images/hero2.jpeg') }}" alt="Gambar 2" class="w-full h-full object-cover">
              </div>
          </div>
      </div>
  </div>
</section>
