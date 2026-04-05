<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Contact Controller
|--------------------------------------------------------------------------
*/

class ContactController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Kirim Pesan Kontak
    |--------------------------------------------------------------------------
    */

    public function send(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Input
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        try {
            /*
            |--------------------------------------------------------------------------
            | Kirim Email
            |--------------------------------------------------------------------------
            */
            
            Mail::send('emails.contact', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'messageContent' => $validated['message'],
            ], function ($message) use ($validated) {
                $message->to('sistempengaduanbullying@gmail.com') // Email tujuan
                        ->subject('Pesan Kontak: ' . $validated['subject'])
                        ->replyTo($validated['email'], $validated['name']);
            });

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.');
        } catch (\Exception $e) {
             /*
            |--------------------------------------------------------------------------
            | Penanganan Error
            |--------------------------------------------------------------------------
            */

            Log::error('Contact form error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Maaf, terjadi kesalahan saat mengirim pesan. Silakan coba lagi atau hubungi kami langsung.');
        }
    }
}
