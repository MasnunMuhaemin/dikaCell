@extends('layouts.app')

@section('content')
    @include('sections.hero')
    @include('sections.layanan')
    @include('sections.tentang')
    @include('sections.kategori')
    @include('sections.kontak')
    @include('sections.faq')

    <form id="wishlist-form" action="{{ route('wishlist.index', $product->id ?? 1) }}" method="GET" style="position: fixed; bottom: 20px; right: 20px; z-index: 999;">
        @csrf
        <button type="submit" class="bg-pink-600 text-white py-2 px-4 rounded-full hover:bg-pink-700 flex items-center gap-2 shadow-lg">
            <i class="fas fa-heart"></i> Lihat Wishlist
        </button>
    </form>

<script>
    document.getElementById('wishlist-form').addEventListener('submit', function(event) {
        @auth
            return true;
        @else
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Anda belum login!',
                text: 'Anda tidak bisa melihat wishlist karena belum login.',
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
@endsection
