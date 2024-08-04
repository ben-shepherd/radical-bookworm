<?php

declare(strict_types=1);

namespace App\Domains\Books\Models;

use App\Base\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $bookId
 * @property string $userId
 */
class BookFavourite extends Model
{
    protected $table = 'books_favourites';

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'bookId', 'id');
    }
}
