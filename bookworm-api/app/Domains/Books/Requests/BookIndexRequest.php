<?php

declare(strict_types=1);

namespace App\Domains\Books\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string'],
            'page' => ['nullable', 'integer', 'min:1'],
            'pageSize' => ['nullable', 'integer', 'min:10', 'max:100']
        ];
    }
}
