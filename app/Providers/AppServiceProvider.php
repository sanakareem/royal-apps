<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(\App\Services\Api\ApiClient::class, function ($app) {
            return new \App\Services\Api\ApiClient();
        });

        $this->app->singleton(\App\Services\Api\AuthorService::class, function ($app) {
            return new \App\Services\Api\AuthorService($app->make(\App\Services\Api\ApiClient::class));
        });

        $this->app->singleton(\App\Services\Api\BookService::class, function ($app) {
            return new \App\Services\Api\BookService($app->make(\App\Services\Api\ApiClient::class));
        });
    }

    public function boot(): void
    {
        //
    }
}