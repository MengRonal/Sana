<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// 💡 បន្ថែមបន្ទាត់មួយនេះដើម្បីឱ្យស្គាល់ Class Paginator
use Illuminate\Pagination\Paginator; 

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
        // កូដដែលអ្នកបានដាក់នឹងដំណើរការបានយ៉ាងត្រឹមត្រូវ
        Paginator::useBootstrapFive();
    }
}