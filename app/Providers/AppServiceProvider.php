<?php

namespace App\Providers;

use App\Models\System;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('system')) {
            $system = System::first();
            if ($system) {
                view()->share('system', $system);
            }
        }
    
        
    }
}
