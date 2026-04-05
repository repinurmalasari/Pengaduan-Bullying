<?php

namespace App\Listeners;

use App\Models\LoginHistory;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $userAgent = request()->userAgent() ?? 'Unknown';
        
        // Simple device detection
        $device = 'Desktop';
        if (preg_match('/mobile|android|iphone|ipad|phone/i', $userAgent)) {
            $device = 'Mobile';
        }
        
        // Simple browser detection
        $browser = 'Unknown';
        if (preg_match('/MSIE|Trident/i', $userAgent)) {
            $browser = 'Internet Explorer';
        } elseif (preg_match('/Edge/i', $userAgent)) {
            $browser = 'Microsoft Edge';
        } elseif (preg_match('/Chrome/i', $userAgent)) {
            $browser = 'Google Chrome';
        } elseif (preg_match('/Safari/i', $userAgent)) {
            $browser = 'Safari';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            $browser = 'Mozilla Firefox';
        }
        
        // Simple platform detection
        $platform = 'Unknown';
        if (preg_match('/Windows/i', $userAgent)) {
            $platform = 'Windows';
        } elseif (preg_match('/Mac/i', $userAgent)) {
            $platform = 'Mac OS';
        } elseif (preg_match('/Linux/i', $userAgent)) {
            $platform = 'Linux';
        } elseif (preg_match('/Android/i', $userAgent)) {
            $platform = 'Android';
        } elseif (preg_match('/iOS|iPhone|iPad/i', $userAgent)) {
            $platform = 'iOS';
        }

        LoginHistory::create([
            'user_id' => $event->user->id,
            'ip_address' => request()->ip(),
            'user_agent' => $userAgent,
            'device' => $device,
            'browser' => $browser,
            'platform' => $platform,
            'login_at' => now(),
        ]);
    }
}
