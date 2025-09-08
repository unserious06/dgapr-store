<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

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
        View::composer('*', function ($view) {
        $view->with('navbarCategories', Category::all()); //navbar categories are passed to all views
        });

        View::composer('*', function ($view) {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $cartCount = $cart->items()->sum('quantity');
            $view->with('cartCount', $cartCount);
        } else {
            $view->with('cartCount', 0);
        }
    });
    }
}
