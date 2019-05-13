<?php

namespace App\Providers;

use App\Models\NotifyList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        Carbon::setLocale('id');

        view()->composer('*', function (View $view){
            if (Auth::check()){
                $notify = NotifyList::where('user_id','=',Auth::user()->id)
                    ->orderBy('created_at','DESC')
                    ->limit(5)
                    ->get();
                $view->with('notify', $notify);
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
