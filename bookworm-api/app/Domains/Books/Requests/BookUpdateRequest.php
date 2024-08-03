<?php

declare(strict_types=1);

namespace App\Domains\Books\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @OA\Schema(
 *     schema="BookUpdateRequest",
 *     type="object",
 *     required={"price", "rating"},
 *     @OA\Property(property="price", type="number", format="float"),
 *     @OA\Property(property="rating", type="number", format="float"),
 * )
 */
class BookUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'price' => ['nullable', 'numeric', 'min:0'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5']
        ];
    }

    public function messages(): array
    {
        return [
            'rating.min' => 'Rating must be between 0 and 5',
            'rating.max' => 'Rating must be between 0 and 5',
        ];
    }
}
