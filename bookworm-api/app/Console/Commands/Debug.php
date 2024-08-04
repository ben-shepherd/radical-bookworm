<?php

namespace App\Console\Commands;


use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\Services\APIs\ExternalBookService;
use App\Domains\Books\Services\APIs\NyTimesService;
use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class Debug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:debug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws GuzzleException
     */
    public function handle()
    {
        /** @var ExternalBookService $api */
        $api = app()->make(ExternalBookService::class);

        $options = new BooksApiGetOptionsDTO('java');
        $books = $api->getBookDTOs($options);

        dd($books, count($books));
    }
}
