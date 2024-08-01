<?php

declare(strict_types=1);

namespace App\Domains\Books\Models;

use App\Base\Model;
use MongoDB\Laravel\Relations\BelongsTo;

/**
 * @property string $bookId
 * @property string $userId
 */
class BookFavourite extends Model
{
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'bookId', '_id');
    }
}
