<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            'space_id' => ['required', 'int', 'min:0', 'exists:spaces,id'],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
