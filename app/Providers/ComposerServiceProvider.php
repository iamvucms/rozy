<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Cart;
use Illuminate\Support\Facades\Auth;
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*',function($view){
            $view->with('categories',Category::get());
            $view->with('myCart',new Cart);
            $view->with('user',Auth::user());
        });
        
    }
}
