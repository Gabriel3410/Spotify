<?php

namespace App\Providers;

use App\Http\Middleware\CheckUserPreferences;
use Illuminate\Support\Facades\Route;
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
        Route::middleware('web')
            ->group(function () {
                Route::middleware(CheckUserPreferences::class)
                    ->group(base_path('routes/web.php'));
            });
    }
}
