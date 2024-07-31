<?php

declare(strict_types=1);

namespace App\Base;

use Illuminate\Contracts\Database\Eloquent\Builder;

abstract class Factory
{
    public function __construct(private readonly string $modelClass)
    {
    }

    public function create(): Model
    {
        return new $this->modelClass();
    }
}
