@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen w-full bg-gray-50">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif
        <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-sm">
            <h2 class="text-2xl font-bold text-center mb-2">Verifikasi OTP</h2>
            <p class="text-sm mb-6">Kode verifikasi dikirimkan melalui email: <span class="font-bold">{{ Session::get('email') }}</span></p>
            <form method="POST" action="{{ route('auth.verify.otp.submit') }}">
                @csrf

                <div class="mb-4">
                    <label for="otp" cla q
                    ss="block text-gray-700 font-medium mb-2">Masukkan OTP</label>
                    <input id="otp" type="text"
                        class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('otp') border-red-500 @enderror"
                        name="otp" required>
                    @error('otp')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 rounded-lg transition mt-4">
                    Verifikasi
                </button>
            </form>
            <form method="POST" action="{{ route('auth.resend.otp') }}">
                @csrf
                <input type="hidden" name="email" value="{{ Session::get('email') }}">
                <button type="submit"
                    class="mt-3 w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 rounded-lg transition">
                    Kirim Ulang Kode Verifikasi
                </button>
            </form>
        </div>
    </div>
@endsection