<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductsRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|array',
            'products.*' => 'required|exists:products,id',
            'quantity'   => 'required|array',
            'quantity.*' => 'required|numeric|min:1',
            'partner'    => 'required|exists:partners,id',
            'status'     => 'required',
        ];
    }
}
