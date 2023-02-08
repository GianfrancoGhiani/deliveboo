<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "customer_firstname" => 'required',
            "customer_lastname" => 'required',
            "customer_email" => 'required|email',
            "customer_address" => 'required',
            "customer_tel" => 'required',
            "price" => 'required',
            "description" => "required",
            "paid" => 'boolean'
        ];
    }
    public function messages()
    {
        return [
            "customer_firstname.required" => 'The order must need this field',
            "customer_lastname.required" => 'The order must need this field',
            "customer_email.required" => 'The order must need this field',
            "customer_email.email" => 'The order must be an email address',
            "customer_address.required" => 'The order must need this field',
            "customer_tel.required" => 'The order must need this field',
            "price.required" => 'The order must need this field',
            "description.required" => "The order must need this field",
            "paid.boolean" => 'Paid must be a boolean'
        ];
    }
}
