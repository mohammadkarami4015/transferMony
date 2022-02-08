<?php

namespace App\Providers;


use Illuminate\Http\Response;
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

        Response::macro('success', function ($data = null) {
            return response()->json([
                'status' => 200,
                'errors' => false,
                'message' => 'successful',
                'data' => $data,
            ], 200);
        });

        Response::macro('error', function ($message = null, $code = 400) {
            return response()->json([
                'status' => $code,
                'errors' => true,
                'message' => $message,
            ], $code);
        });
    }
}
