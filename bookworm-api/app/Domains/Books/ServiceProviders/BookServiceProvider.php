<?php

declare(strict_types=1);

namespace App\Domains\Books\ServiceProviders;

use App\Domains\Books\Middleware\BooksMiddleware;
use App\Domains\Books\Services\APIs\NyTimesService;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class BookServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $nyTimesBaseUrl = config('books.nytimes.baseUrl');

        // Setup NyTimes Book Api
        $this->app->when(NyTimesService::class)
            ->needs(ClientInterface::class)
            ->give(static function () use ($nyTimesBaseUrl) {
                return new Client([
                    'base_uri' => $nyTimesBaseUrl,
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]);
            });
    }

    public function boot(): void
    {
        $this->mapMiddleware();
        $this->mapBooksRoutes();
    }

    private function mapMiddleware(): void
    {
        /** @var Router $router */
        $router = app()->make(Router::class);
        $router->aliasMiddleware('books-middleware', BooksMiddleware::class);
        $router->aliasMiddleware('cors', HandleCors::class);
    }

    private function mapBooksRoutes(): void
    {
        Route::prefix('books/v1')
            ->namespace('')
            ->middleware(['books-middleware', 'cors'])
            ->group(base_path('app/Domains/Books/Routes/Routes.php'));
    }
}
