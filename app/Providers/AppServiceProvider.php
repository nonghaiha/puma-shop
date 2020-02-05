<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
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
        
        view()->composer('*', function ($view) 
        {
            $cart = new Cart();
            $view->with([
                'name' => "Demo name global",
                'carts' => $cart,
                'categories' => Category::orderBy('name','ASC')->get()
            ]);    
        }); 
    }
}
