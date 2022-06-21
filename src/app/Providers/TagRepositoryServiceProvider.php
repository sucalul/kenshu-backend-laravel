<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class TagRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\TagRepositoryInterface::class, function ($app) {
            return new \App\Repositories\TagRepository(
                new \App\Models\Tag,
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
