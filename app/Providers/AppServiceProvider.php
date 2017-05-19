<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('available', function($attribute, $value, $parameters, $validator) {
            $count = DB::table($parameters[0])
                        ->where("deleted",0)
                        ->where($parameters[1],$value)
                        ->count();
            return ($count == 1?FALSE:TRUE);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
