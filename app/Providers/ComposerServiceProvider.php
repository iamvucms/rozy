<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Cart;
use App\Product;
use App\Keyword;
use App\Enjoy;
use App\Order;
use App\Review;
use App\Traffic;
use App\City;
use App\Shipper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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
        if(empty(Cookie::get('is_view'))){
            Cookie::queue('is_view',true,900);
            $traffic = Traffic::whereRaw("DAY(NOW())=DAY(updated_at) AND MONTH(NOW())=MONTH(updated_at) AND YEAR(NOW())=YEAR(updated_at)")->first();
            if($traffic===null){
                Traffic::insert(['view_count'=>1]);
            }else{
                $traffic->view_count = $traffic->view_count+1;
                $traffic->save();
            }
        }
         
        View::composer('*',function($view){
            if(Auth::user()){
                $user = Auth::user();
                $user->last_action = date('Y-m-d H:i:s');
                $user->save();
            }
            $view->with('categories',Category::orderBy('order','ASC')->get());
            $view->with('myCart',new Cart);
            $view->with('user',Auth::user());
            $view->with('enjoy',new Enjoy);
        });
        View::composer(['Admin.adddiscount','Admin.editdiscount'],function($view){
            $view->with('products',Product::get());
        });
        View::composer('payment', function ($view) {
            $view->with('city',new City);
            $view->with('shippers',new Shipper);
        });
        View::composer('Admin.index', function ($view) {
            $view->with('order',new Order);
            $view->with('review',new Review);
            $view->with('traffic',new Traffic);
            $view->with('category',new Category);
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
