<?php

namespace App\Http\Requests\Housings;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateHousingRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'country' => 'required|string',
            'zip'=> 'required|string|max:12|regex:/^[0-9\-]+$/',
            'city' => 'required|string|max:255',
            'nr_of_slots' => 'required|integer|max:255',
            'street' => 'required|string|max:255',
            'house_nr' => 'required|integer|min:1',
            'description' => 'required|string',
            'image' => 'image|max:4096',
        ];
    }
}
