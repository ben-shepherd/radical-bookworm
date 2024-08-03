<?php

namespace Tests\Domains\Books\Services\APIs;

use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\Services\APIs\NyTimesService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class NyTimesServiceTest extends TestCase
{
    private NyTimesService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app()->make(NyTimesService::class);
    }

    public function testGetBooks()
    {
        $options = new BooksApiGetOptionsDTO();
        $books = $this->service->getBookDTOs($options);

        assert($books instanceof Collection, 'Collection expected');

        $this->assertNotEmpty($books, 'Collection should not be empty');

        $this->assertNotEmpty($books[0]->title, 'Title should not be empty');

        Log::info('Books: ' . count($books));
    }
}
