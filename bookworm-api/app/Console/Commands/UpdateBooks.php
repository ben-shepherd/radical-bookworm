<?php

namespace App\Console\Commands;

use App\Domains\Books\Exceptions\UpdateBooksException;
use App\Domains\Books\Services\BooksApiService;
use Illuminate\Console\Command;

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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws UpdateBooksException
     */
    public function handle()
    {
        /** @var BooksApiService $booksService */
        $booksService = app()->make(BooksApiService::class);
        $booksService->updateBooks();
    }
}
