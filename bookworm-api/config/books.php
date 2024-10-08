<?php

return [

    'apis' => [
        App\Domains\Books\Services\APIs\NyTimesService::class,
        App\Domains\Books\Services\APIs\ExternalBookService::class,
    ],

    'nytimes' => [
        'baseUrl' => env('NYTIMES_API_BASE_URL'),
        'apiKey' => env('NYTIMES_API_KEY'),
    ]
];
