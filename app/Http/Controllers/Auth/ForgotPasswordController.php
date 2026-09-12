<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;

class ForgotPasswordController extends Controller
{
    // Show form to request password reset
    public function showForgotPasswordForm()
    {
        return view('before-login.forgot-password');
    }

    // Handle the form submission and send the verification code
    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:users,phone',
        ]);

        $user = User::where('phone', $request->phone)->first();
        $verificationCode = rand(100000, 999999);

        // Store the verification code in session (or use another persistent storage)
        Session::put('verification_code', $verificationCode);
        Session::put('phone', $request->phone);

        // Send SMS (Twilio example)
        $account_sid = env('TWILIO_SID');
        $auth_token = env('TWILIO_AUTH_TOKEN');
        $twilio_number = env('TWILIO_NUMBER');

        $client = new Client($account_sid, $auth_token);
        $client->messages->create($request->phone, [
            'from' => $twilio_number,
            'body' => "Kode Verifikasi Lupa Password Anda Adalah $verificationCode , Jika Anda Tidak Merasa Merubah Password, Jangan Berikan Kode Ini Kepada Siapapun!"
        ]);

        return redirect()->route('password.verifyCode')->with('success', 'Verification code sent!');
    }

    public function showVerifyCodeForm()
    {
        return view('before-login.verify-code');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        if ($request->code == Session::get('verification_code')) {
            return redirect()->route('password.reset');
        }

        return back()->withErrors(['code' => 'The verification code is incorrect.']);
    }

    // Show form to reset password
    public function showResetPasswordForm()
    {
        return view('before-login.reset-password');
    }

    // Handle password reset
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('phone', Session::get('phone'))->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Clear session
        Session::forget('verification_code');
        Session::forget('phone');

        return redirect('/login')->with('success', 'Your password has been reset successfully.');
    }
}