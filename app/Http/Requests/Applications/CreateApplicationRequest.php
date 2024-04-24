<?php

namespace App\Http\Requests\Applications;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateApplicationRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'housing_id' => ['required', 'integer'],
            'duration' => ['required', 'integer', 'min:1'],
            'message' => ['required', 'string' ,'min:15', 'max:1024'],
        ];
    }
}
