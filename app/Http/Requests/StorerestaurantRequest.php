<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorerestaurantRequest extends FormRequest
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
            'name.required' => 'il nome è obbligatorio',
            'address.required' => 'Il campo è obbligatorio',
            'piva.required' => 'Il campo è obbligatorio',
            'piva.unique' => 'Il campo deve contentere una combinazione alfanumerica univoca',
            'opening_time' => 'Il campo è obbligatorio',
            'closing_time' => 'Il campo è obbligatorio',
        ];
    }
}
