<?php

declare(strict_types=1);

namespace App\Base;

use Illuminate\Contracts\Database\Eloquent\Builder;

abstract class Repository
{
    public function __construct(private readonly string $modelClass)
    {
    }

    public function createQueryBuilder(): Builder
    {
        return forward_static_call([$this->modelClass, 'query']);
    }

    public function find(string $id): ?Model
    {
        return $this->createQueryBuilder()->findOrFail($id);
    }

    public function findBy(array $attributes): ?Model
    {
        return $this->createQueryBuilder()->where($attributes)->firstOrFail();
    }
}
