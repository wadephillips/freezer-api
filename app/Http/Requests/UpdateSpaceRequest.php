<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpaceRequest extends FormRequest
{

    public function rules(): array
    {

        return [
            'name' => ['required'],
        ];
    }

}
