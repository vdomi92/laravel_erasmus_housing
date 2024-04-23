<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;

class CreateApplicationRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'housing_id' => ['required', 'integer'],
            'duration' => ['required', 'integer', 'min:1'],
            'message' => ['required', 'string' ,'min:1', 'max:1024'],
        ];
    }
}
