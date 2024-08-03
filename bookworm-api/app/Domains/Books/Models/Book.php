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
 * @OA\Schema(
 *     title="Book",
 *     description="Book model",
 *     @OA\Property(property="externalId", type="string"),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="authors", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="image", type="string"),
 *     @OA\Property(property="link", type="string"),
 *     @OA\Property(property="rating", type="integer"),
 *     @OA\Property(property="price", type="number", format="float")
 * )
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
