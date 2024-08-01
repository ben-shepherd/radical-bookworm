<?php

declare(strict_types=1);

namespace App\Domains\Books\Models;

use App\Base\Model;

/**
 * @property string $externalId
 * @property string $title
 * @property array $authors
 * @property string $description
 * @property string $image
 * @property string $link
 * @property int $rating
 * @property float $price
 */
class Book extends Model
{
    protected $fillable = [
        'rating',
        'price'
    ];
    
    public function setPriceAttribute(float $price): void
    {
        $this->attributes['price'] = (float)number_format($price, 2, '.');
    }
}
