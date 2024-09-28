<?php

namespace App\Providers;

use App\Interfaces\AuthorRepositoryInterface;
use App\Interfaces\BookRepositoryInterface;
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Services\ImageService;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
    * Register Repository dependency injection
    */
    public function register(): void
    {
        // Bind the AuthorRepositoryInterface to its implementation
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
    
        // Bind the BookRepositoryInterface to its implementation
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);

        $this->app->bind(ImageService::class);
    }

    /**
    * Bootstrap services.
    */
    public function boot(): void
    {
        //
    }
}
