<?php

namespace App\Console\Commands;

use App\Domains\Books\Exceptions\BooksApiException;
use App\Domains\Books\Services\BooksApiService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Container\BindingResolutionException;

class UpdateBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:updateBooks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches books from APIs and stores them in the books collection';

    /**
     * Execute the console command.
     * @throws BooksApiException
     * @throws BindingResolutionException
     */
    public function handle(): void
    {
        /** @var BooksApiService $booksService */
        $booksService = app()->make(BooksApiService::class);
        $booksService->updateBooks();
    }
}
