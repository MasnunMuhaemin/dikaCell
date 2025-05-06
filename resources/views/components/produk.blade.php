<section class="py-8 px-4">
    <h2 class="text-xl font-semibold mb-6">Aksesoris</h2>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @for ($i = 0; $i < 15; $i++)
            <div class="bg-blue-100 rounded-lg shadow hover:shadow-lg transition duration-300 p-3 relative">
                <div class="aspect-w-1 aspect-h-1 bg-white rounded-lg overflow-hidden">
                    <img src="{{ asset('images/aksesoris.png') }}" alt="Produk" class="object-cover w-full h-full">
                </div>

                <div class="mt-2">
                    <p class="text-red-600 font-semibold text-sm">Rp 100.000</p>
                    <p class="text-gray-500 line-through text-xs">Rp 120.000</p>
                    <p class="text-sm mt-1">Casing iPhone 11 Pro</p>
                </div>

                <div class="absolute top-2 right-2 bg-white rounded-full w-6 h-6 flex items-center justify-center text-red-500 text-xs font-bold shadow">
                    % 
                </div>
            </div>
        @endfor
    </div>
</section>
