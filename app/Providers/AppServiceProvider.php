<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

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
        RateLimiter::for('chat', fn (Request $request) => Limit::perMinute(20)
            ->by($request->ip())
            ->response(fn (Request $request, array $headers) => response()->json([
                'error' => 'Too many messages. Please wait a minute and try again.',
            ], 429, $headers)));
    }
}
