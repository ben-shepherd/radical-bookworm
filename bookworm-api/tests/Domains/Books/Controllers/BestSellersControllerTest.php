<?php

namespace Tests\Domains\Books\Controllers;

use App\Domains\Books\Contracts\BooksApiServiceContract;
use App\Domains\Books\Controllers\BestSellersController;
use App\Domains\Books\Requests\BestSellersRequest;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class BestSellersControllerTest extends TestCase
{
    private BestSellersController $controller;
    private BooksApiServiceContract $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new BestSellersController();
        $this->service = app()->make(BooksApiServiceContract::class);
    }

    public function testInvoke()
    {
        $request = new BestSellersRequest();
        $request->setContainer(app());
        $request->replace([
            'search' => '',
            'pageSize' => 20,
            'cache' => 'false'
        ]);

        $request->validateResolved();

        $response = $this->controller->__invoke($this->service, $request);

        $this->assertInstanceOf(JsonResponse::class, $response, 'JsonResponse expected');

        $this->assertSame(200, $response->getStatusCode(), 'Status code should be 200');

        $responseArray = json_decode($response->getContent(), true);

        $this->assertIsArray($responseArray, 'Response should be an array');

        assert(count($responseArray) > 0, 'Array should not be empty');
    }
}
