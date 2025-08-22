<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Truyền biến categories vào view header
        View::composer('frontend.header', function ($view) {
            $navCategories = Category::where('is_active', 1)
                ->where('isDeleted', 0)
                ->where('show_in_nav', 1)
                ->get();

            $otherCategories = Category::where('is_active', 1)
                ->where('isDeleted', 0)
                ->where('show_in_nav', 0)
                ->get();

            $view->with([
                'navCategories' => $navCategories,
                'otherCategories' => $otherCategories,
            ]);
        });
    }
}
