<?php

namespace App\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;

/**
 * @OA\Info(
 *     title="Bookworm API",
 *     version="1.0.0",
 *     description="Bookworm API documentation",
 * )
 */
class AppServiceProvider extends ServiceProvider
{
    public function provides()
    {
        return [
            ClientInterface::class,
        ];
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
