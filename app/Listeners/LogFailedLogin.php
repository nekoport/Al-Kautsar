<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Log;

class LogFailedLogin
{
    public function handle(Failed $event): void
    {
        Log::channel('admin')->warning('Login gagal', [
            'email' => $event->credentials['email'] ?? 'unknown',
            'ip' => request()?->ip(),
            'user_agent' => request()?->userAgent(),
        ]);
    }
}
