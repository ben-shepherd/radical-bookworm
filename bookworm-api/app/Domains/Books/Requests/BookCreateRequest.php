<?php

declare(strict_types=1);

namespace App\Domains\Books\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
