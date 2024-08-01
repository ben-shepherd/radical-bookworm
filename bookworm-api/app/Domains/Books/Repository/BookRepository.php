<?php

declare(strict_types=1);

namespace App\Domains\Books\Repository;

use App\Base\Repository;
use App\Domains\Books\Models\Book;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class BookRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Book::class);
    }

    public function findByExternalId(string $externalId): Book
    {
        /** @var Book */
        return $this->findBy(['externalId' => $externalId]);
    }

    public function findManyBySearchQuery(string $search, int $page = 1, int $pageSize = 10): Builder
    {
        $query = $this->createQueryBuilder();

        if (strlen($search)) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        $query->orderBy('title');

        return $query->skip(($page - 1) * $pageSize)
            ->take($pageSize);
    }

    /**
     * @return Collection<Book>
     */
    public function findUserFavouriteBooks(User $user): Collection
    {
        return $user->favouriteBooks()
            ->with('book')
            ->get()
            ->select(['book'])
            ->map(fn($bookFavourite) => $bookFavourite['book']);
    }
}
