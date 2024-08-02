<?php

declare(strict_types=1);

namespace App\Domains\Books\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BestSellersRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string'],
            'pageSize' => ['nullable', 'numeric', 'min:10', 'max:100']
        ];
    }
}
