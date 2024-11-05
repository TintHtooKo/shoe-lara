<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        View::composer('admin.layout.master',function($view){
            $unreadContact = Contact::where('is_read',false)->count();
            $view->with('unreadContact',$unreadContact);
        });
    }
}
