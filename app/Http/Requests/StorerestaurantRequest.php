<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'address' => 'required', 
            'piva' => 'required|unique',
            'opening_time' => 'required',
            'closing_time' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name is required',
            'address.required' => 'The field is required',
            'piva.required' => 'The field is required',
            'piva.unique' => 'The field must contain a unique alphanumeric combination',
            'opening_time' => 'The field is required',
            'closing_time' => 'The field is required',
        ];
    }
}
