<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmailNotification;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }

    public function loginVerify(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required',
            ]);

            $credentials = $request->only(['email', 'password']);

            if (Auth::attempt($credentials)) {
                $user = User::where('email', $request->email)->first();
                if ($user->hasRole('admin')) {
                    return redirect('/admin')->with('success', 'Akun berhasil diverifikasi dan Anda telah login.');
                } else {
                    $categories = Category::with('products')->get();
                    $products = Product::latest()->limit(3)->get();

                    return view('pages.landing', [
                        'categories' => $categories,
                        'products' => $products
                    ]);
                }
            } else {
                return redirect()->back()->with('error', 'Ada Kesalahan Saat Login');
            }
        } catch (Exception $e) {
            toastr()->warning('Invalid', $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // cibtroller

    public function registerVerify(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:7',
            ], [
                'name.required' => 'Nama wajib diisi.',
                'password.required' => 'Kata sandi wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'no_hp' => $request->phone,
                'alamat' => $request->alamat,
            ]);

            $user->assignRole('customer');

            $otp = rand(100000, 999999);

            $user->otp = $otp;
            $user->save();

            Session::forget('email');
            Session::put('email', $user->email);
            Session::save();

            try {
                Mail::to($user->email)->send(new VerifyEmailNotification($otp));
                toastr()->success('success', 'Register successfully');
                return redirect()->route('auth.verify.otp.form');
            } catch (\Exception $e) {
                $user->delete();
                return redirect()->back()->withErrors(['email' => 'Gagal mengirimkan OTP: ' . $e->getMessage()]);
            }
        } catch (Exception $e) {
            toastr()->warning('invalid', $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function logout()
    {
        try {
            Auth::logout();

            return redirect('/');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
