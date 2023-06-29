<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer('layouts.total-card', function ($view) {
            $totalTransactions = DB::table('transactions')->count();
            $totalStaff = DB::table('staffs')->count();
            $totalIncomes = DB::table('transactions')->sum('total');
            $totalProductsSold = DB::table('products_has_transactions')->sum('quantity');
            
            $view->with(compact('totalTransactions', 'totalStaff', 'totalIncomes', 'totalProductsSold'));
        });
    }
}
