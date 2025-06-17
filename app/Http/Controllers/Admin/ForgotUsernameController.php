<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class ForgotUsernameController extends Controller
{
    // Tampilkan form lupa username
    public function showForm()
    {
        return view('admin.pages.auth.forgot-username');
    }

    // Proses kirim username ke email
    public function sendUsername(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        Mail::send('emails.username-reminder', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Pengingat Username Anda');
        });

        return back()->with('status', 'Username telah dikirim ke email Anda.');
    }
}

