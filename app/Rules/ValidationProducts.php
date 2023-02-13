<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Product;

class ValidationProducts implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $productsFound = false;
        foreach ($value as $product) {
            $product = Product::find($value);
            if (Product::find($value)) {
                $productsFound = True;
            } else {
                $productsFound = False;
            }
        }
        return $productsFound;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Products are not found';
    }
}
