<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator; // <--- 1. JANGAN LUPA IMPORT INI
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        // Konfigurasi Schema yang sudah kamu buat sebelumnya
        Schema::defaultStringLength(191);

        // 2. TAMBAHKAN BARIS INI:
        // Mengubah tampilan pagination bawaan menjadi Bootstrap 5
        Paginator::useBootstrapFive();
    }
}