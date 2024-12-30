<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

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
    public function boot()
    {
        // Membagikan data $newOrders ke semua view
        View::composer('*', function ($view) {
            $newOrders = Order::where('order_status', 'Proses')->orderBy('created_at', 'desc')->get();
            $view->with('newOrders', $newOrders);
            
        });

        // Membagikan data $admin ke semua view 
        View::composer('*', function ($view) { 
            $admin = Auth::guard('admin')->user(); 
            $view->with('admin', $admin); 
        });

    }
}
