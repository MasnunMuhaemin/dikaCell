<div class="relative isolate overflow-hidden bg-custom">
    <div class="py-24 max-w-8xl mx-auto px-8 sm:px-10 lg:px-12 flex flex-col md:flex-row gap-12">
        <div class="flex flex-col text-left basis-1/2">
            <p class="inline-block text-primary text-3xl font-bold mb-4">FAQ</p>
            <p class="sm:text-4xl text-3xl font-extrabold text-base-content overflow-hidden">Butuh Info? Ini Jawaban dari Kami.</p>
            <p class="mt-4 text-base text-base-content/70 leading-relaxed max-w-md">
                Temukan jawaban cepat untuk pertanyaan umum seputar layanan DIKA CELL. Yuk, lihat dulu sebelum menghubungi kami!
            </p>
        </div>

        <ul class="basis-1/2">
            @php
                $faqs = [
                    ['question' => 'Layanan apa saja yang tersedia di DIKA CELL?', 'answer' => 'Penjualan aksesoris HP, servis, dan konsultasi kerusakan gratis.'],
                    ['question' => 'Apakah cek kerusakan benar-benar gratis?', 'answer' => 'Ya, pengecekan dan konsultasi 100% gratis.'],
                    ['question' => 'Apakah spare part-nya original?', 'answer' => 'Kami memakai spare part original atau setara berkualitas.'],
                    ['question' => 'Apakah teknisinya berpengalaman?', 'answer' => 'Ya, teknisi kami terlatih dan profesional.'],
                    ['question' => 'Berapa lama proses servis?', 'answer' => 'Umumnya cepat, tergantung tingkat kerusakan.']
                ];
            @endphp

            @foreach ($faqs as $faq)
                <li class="group">
                    <button class="relative flex gap-2 items-center w-full py-5 text-base font-semibold text-left border-t md:text-lg border-base-content/10" aria-expanded="false">
                        <span class="flex-1 text-base-content">{{ $faq['question'] }}</span>
                        <svg class="flex-shrink-0 w-4 h-4 ml-auto fill-current" viewBox="0 0 16 16">
                            <rect y="7" width="16" height="2" rx="1" class="transform origin-center transition duration-200 ease-out"></rect>
                            <rect y="7" width="16" height="2" rx="1" class="group-hover:opacity-0 transform origin-center rotate-90 transition duration-200 ease-out"></rect>
                        </svg>
                    </button>
                    <div class="transition-all duration-300 ease-in-out group-hover:max-h-60 max-h-0 overflow-hidden">
                        <div class="pb-5 leading-relaxed text-base-content/80">
                            <div class="space-y-2 leading-relaxed">
                                {{ $faq['answer'] }}
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
