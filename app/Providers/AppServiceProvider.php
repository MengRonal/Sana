<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Settings;

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
        Paginator::useBootstrapFive();

        // ផ្ញើ $appSetting (ឈ្មោះហាង, logo, tel) ទៅ layout/admin.blade.php
        View::composer('layout.admin', function ($view) {
            $setting = Schema::hasTable('Settings')
                ? Settings::orderBy('id', 'desc')->first()   // យក setting ថ្មីបំផុត
                : null;

            $view->with('appSetting', $setting);
        });
    }
}