<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cookie;
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
        Paginator::useBootstrapFive();
        Model::preventLazyLoading(!app()->isProduction());

        View::composer('app.nav', function ($view) {
            $categories = Category::withCount(['products'])
                ->orderBy('slug')
                ->get();
            $brands = Brand::withCount(['products'])
                ->orderBy('slug')
                ->get();

            if (Cookie::has('cart')) {
                $cartIds = count(explode(',', Cookie::get('cart')));
            } else {
                $cartIds = 0;
            }

            $view->with([
                'categories' => $categories,
                'brands' => $brands,
                'cartIds' => $cartIds,
            ]);
        });
    }
}
