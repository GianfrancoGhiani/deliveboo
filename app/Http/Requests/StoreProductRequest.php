<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StoreProductRequest extends FormRequest
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
            'name' => ['required',Rule::unique('products')->where('restaurant_id' , Auth::user()->restaurant->id)->ignore($this->product)],
            'price' => 'required|numeric|between:0,99.99',
            'available' => 'required',
            'discount' => 'nullable|numeric|between:0,90.00',
            'ingredients' => 'required',
            'image_url' => 'image|required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name is required',
            'price.required'=> 'The price is required',
            'price.between' => 'The price must be between 0 and 99.99',
            'available.required' => 'The field is required',
            'dicount.between'=> 'The discount must be between 0 and 90.00',
            'ingredients.required' => 'The field is required',
            'image_url.image' => 'The field must contain an image',
            'image_url.required' => 'The image fieald is required',

        ];
    }
}
