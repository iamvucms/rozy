<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Cart;
use App\Product;
use App\Keyword;
use App\Enjoy;
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
            $view->with('enjoy',new Enjoy);
        });
        View::composer('index', function ($view) {
            $view->with('recommandCats',(new Category)->recommandCategories());
            $view->with('recommandProducts',(new Product())->ProductForYou(60));
            $view->with('mostedKeyword',(new Keyword)->MostSearchKeyword());
        });
        View::composer(['account','cart','detail'], function ($view) {
            $view->with('recommandProducts',(new Product())->ProductForYou(20));
        });
        
    }
}
