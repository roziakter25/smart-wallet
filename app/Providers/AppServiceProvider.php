<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Notification::extend('custom', function ($app) {
            return new class {
                public function send($notifiable, $notification)
                {
                    return $notification->toMail($notifiable);
                }
            };
        });
    }
}
