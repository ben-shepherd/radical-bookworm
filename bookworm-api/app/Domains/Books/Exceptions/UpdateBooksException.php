<?php

declare(strict_types=1);

namespace App\Domains\Books\Exceptions;

class UpdateBooksException extends \Exception
{
    public function __construct(string $message = "There was an error updating the books")
    {
        parent::__construct($message);
    }
}
