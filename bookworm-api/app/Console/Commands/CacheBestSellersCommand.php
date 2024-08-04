<?php

namespace App\Console\Commands;

use App\Console\Schedule\CacheBestSellers;
use App\Domains\Books\Exceptions\BooksApiException;
use Illuminate\Console\Command;
use Illuminate\Contracts\Container\BindingResolutionException;

class CacheBestSellersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:CacheBestSellers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Caches best sellers';

    /**
     * Execute the console command.
     * @throws BooksApiException
     * @throws BindingResolutionException
     */
    public function handle(): void
    {
        app(CacheBestSellers::class)->__invoke();
    }
}
