<?php

namespace App\Providers;

use App\Models\Post;
use App\Observers\PostObserver;
use Filament\Facades\Filament;
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
        // Register observers
        Post::observe(PostObserver::class);

        // Set locale for Filament
        Filament::serving(function () {
            app()->setLocale('id');
        });
    }
}
