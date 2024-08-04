<?php

declare(strict_types=1);

namespace App\Domains\Books\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @OA\Schema(
 *     title="BestSellersSearchRequest",
 *     description="Request to get best selling books",
 *     type="object",
 *     required={"search", "pageSize"},
 *     @OA\Property(property="search", type="string", example="Harry Potter"),
 *     @OA\Property(property="pageSize", type="integer", example=20)
 * )
 */
class BestSellersSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string'],
            'pageSize' => ['nullable', 'numeric', 'min:3', 'max:100']
        ];
    }
}
