<?php

declare(strict_types=1);

namespace App\Domains\Books\Exceptions;

use Exception;

class BooksApiException extends Exception
{
    public function __construct(string $message = "There was an error.")
    {
        parent::__construct($message);
    }
}
