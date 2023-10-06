<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
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
        try {
            $sql = DB::select('select * from empresa');
            foreach ($sql as $value) {
                View::share('empresa', $value->nombre);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        //use Illuminate\Support\Facades\View;  
    }
}
