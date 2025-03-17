<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use OwenIt\Auditing\Models\Audit;

class UserEventSubscriber implements ShouldQueue
{
    use InteractsWithQueue;

    public function handleUserLogin(Login $event)
    {
        Audit::query()->create([
            'auditable_id' => $event->user->id,
            'auditable_type' => "Logged In",
            'event'      => "Logged In",
            'url'        => request()->fullUrl(),
            'ip_address' => request()->getClientIp(),
            'user_agent' => request()->userAgent(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id'    => $event->user->id,
        ]);
    }

    public function handleUserLogout()
    {
        Audit::query()->create([
            'auditable_id' => auth()->user()->id,
            'auditable_type' => "Logged In",
            'event'      => "Logged Out",
            'url'        => request()->fullUrl(),
            'ip_address' => request()->getClientIp(),
            'user_agent' => request()->userAgent(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id'    => auth()->user()->id,
        ]);
    }

    public function subscribe(): array
    {
        return [
            Login::class => 'handleUserLogin',
            Logout::class => 'handleUserLogout',
        ];
    }
}
