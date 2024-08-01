<?php

namespace App\Console\Commands;


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
        $user = User::query()->first();

        $favouriteBooks = $user->favouriteBooks()->with('book')->get();

        dd($favouriteBooks[0]->book);


    }
}
