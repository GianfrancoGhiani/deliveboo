<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'price' => ['required','between:0,99.99'], 
            'available' => 'required',
            'discount' => 'nullable',
            'ingredients' => 'required',
            'image_url' => ['required','image','size:1024']
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'il nome è obbligatorio',
            'price.between' => 'Il prezzo deve essere compreso tra 0 e 99,99',
            'available.required' => 'Il campo è obbligatorio',
            'ingredients.required' => 'Il campo è obbligatorio',
            'image_url.image' => 'Il campo deve contenere un immagine',
            'image_url.size' => 'L immagine non può superare 1mb'
        ];
    }
}
