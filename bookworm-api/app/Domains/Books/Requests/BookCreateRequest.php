<?php

declare(strict_types=1);

namespace App\Domains\Books\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @OA\Schema(
 *     schema="BookCreateRequest",
 *     type="object",
 *     required={"externalId", "title", "authors", "description", "image"},
 *     @OA\Property(property="externalId", type="string"),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="authors", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="image", type="string", format="url"),
 *     @OA\Property(property="link", type="string", format="url"),
 * )
 */
class BookCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'externalId' => ['required', 'string'],
            'title' => ['required', 'string'],
            'authors' => ['required', 'array'],
            'authors.*' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['required', 'url'],
            'link' => ['nullable', 'url'],
        ];
    }
}
