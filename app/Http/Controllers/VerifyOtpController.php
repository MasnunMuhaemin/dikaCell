<?php

namespace App\Http\Controllers;

use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class VerifyOtpController extends Controller
{
    public function showForm(Request $request)
    {
        if (!Session::has('email')) {
            return redirect()->route('auth.login')->with('error', 'Silakan login untuk mendapatkan kode OTP.');
        }

        $email = Session::get('email');
        $cacheKey = 'otp_sent_' . $email;

        if (!Cache::has($cacheKey)) {
            $request['email'] = $email;
            $this->resendOtp(new Request(['email' => $email]));

            Cache::put($cacheKey, true, now()->addMinutes(30));
        }

        return view('auth.emailVerif');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ], [
            'otp.required' => 'OTP wajib diisi.',
            'otp.numeric' => 'OTP harus berupa angka.',
            'otp.digits' => 'OTP harus 6 digit.',
        ]);

        $user = User::where('otp', $request->otp)->first();

        if (!$user) return redirect()->back()->withErrors(['otp' => 'OTP tidak valid.']);

        $user->email_verified_at = now();
        $user->otp = null;
        $user->save();

        $user->assignRole('customer');

        auth()->login($user);

        Notification::make()
            ->title('Email Terverifikasi!')
            ->body('Selamat datang, akun Anda berhasil diverifikasi dan Anda telah login.')
            ->success()
            ->send();

        if($user->hasRole('admin')) {
            return redirect('/admin')->with('success', 'Akun berhasil diverifikasi dan Anda telah login.');
        }else {
            return redirect('pages/landing');
        }
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        $cacheKey = 'otp_resend_' . $request->email;
        if (Cache::has($cacheKey)) {
            $remainingTime = Cache::get($cacheKey) - now()->timestamp;
            return redirect()->back()->with(['error' => "Harap tunggu {$remainingTime} detik sebelum mengirim ulang OTP."]);
        }

        if ($user->email_verified_at) {
            return redirect()->route('admin')->with('success', 'Akun Anda sudah terverifikasi.');
        }

        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->save();

        try {
            Mail::to($user->email)->send(new \App\Mail\VerifyEmailNotification($otp));

            Cache::put($cacheKey, now()->timestamp + 60, 60); // 1 menit

            return redirect()->back()->with('success', 'Kode OTP telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengirim ulang OTP: ' . $e->getMessage()]);
        }
    }
}
