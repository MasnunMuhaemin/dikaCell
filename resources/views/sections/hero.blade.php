<!-- resources/views/sections/hero.blade.php -->
<section class="relative w-full h-screen overflow-hidden">
    <!-- gambar sebagai elemen <img> -->
    <img
      id="hero-img"
      src="/images/hero1.jpeg"
      alt="Hero Image"
      class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500"
    />
  
    <!-- overlay gelap -->
    <div class="absolute inset-0 bg-black/50"></div>
  
    <!-- konten -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
      <p class="text-white uppercase tracking-widest mb-2">Bersama DIKA CELL</p>
      <h1 class="text-white text-4xl sm:text-6xl font-bold mb-4">Pusat Solusi HP</h1>
      <a href="#next-section"
         class="relative inline-block text-sky-400 font-semibold transition duration-300
                after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px]
                after:w-0 after:bg-sky-400 after:transition-all after:duration-300 hover:after:w-full">
         Lihat Selengkapnya
      </a>
    </div>
  
    <!-- tombol prev/next -->
    <button id="prev-btn"
      class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/30 hover:bg-white/60 text-white p-3 rounded-full transition">
      <i class="fas fa-chevron-left text-lg"></i>
    </button>
  
    <button id="next-btn"
      class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/30 hover:bg-white/60 text-white p-3 rounded-full transition">
      <i class="fas fa-chevron-right text-lg"></i>
    </button>
</section>
  

<script>
    document.addEventListener('DOMContentLoaded', function () {
      const images = [
        '/images/hero1.jpeg',
        '/images/hero2.jpeg',
        '/images/hero1.jpeg',
        '/images/hero2.jpeg'
      ];
      let currentIndex = 0;
  
      const heroImg = document.getElementById('hero-img');
      const prevBtn = document.getElementById('prev-btn');
      const nextBtn = document.getElementById('next-btn');
  
      function updateImage() {
        // fade out
        heroImg.style.opacity = 0;
        setTimeout(() => {
          heroImg.src = images[currentIndex];
          // fade in
          heroImg.style.opacity = 1;
        }, 200); // delay sesuai duration-500 / 2
      }
  
      prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateImage();
      });
  
      nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateImage();
      });
    });
</script>
  
