<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;

class ResponseServiceProvider extends ServiceProvider
{
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('api', function ($data, $success = true, $code = 200, $errors = null) use ($factory) {
            
            $customFormat = [
                'success' => $success,
                'code' => $code,
                'errors' => $errors,
                'data' => $data
            ];
            return $factory->make($customFormat);
        });
    }

    public function register()
    {
        //
    }
}