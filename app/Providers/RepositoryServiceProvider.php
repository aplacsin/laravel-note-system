<?php

namespace App\Providers;

use App\Repositories\ImageRepository;
use App\Repositories\ImageRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\NoteRepositoryInterface;
use App\Repositories\NoteRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            NoteRepositoryInterface::class,
            NoteRepository::class
        );

        $this->app->bind(
            ImageRepositoryInterface::class,
            ImageRepository::class
        );
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
