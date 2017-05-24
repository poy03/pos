<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Http\Request;

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
            $db_data = DB::table($parameters[0]);
            $db_data->where("deleted",0);
            $db_data->where($parameters[1],$value);
            if(isset($parameters[2])&&isset($parameters[3])){
                $db_data->where($parameters[2],'<>',$parameters[3]);
            }
            return ($db_data->count() == 1?FALSE:TRUE);
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
