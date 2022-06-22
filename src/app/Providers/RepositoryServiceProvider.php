<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\ArticleRepositoryInterface::class, function ($app) {
            return new \App\Repositories\ArticleRepository(
                new \App\Models\Article,
                new \App\Models\ArticleImage,
                new \App\Models\ArticleTag,
            );
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
