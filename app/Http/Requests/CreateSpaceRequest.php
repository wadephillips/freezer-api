<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSpaceRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:App\Models\Space,name'],
        ];
    }
}
