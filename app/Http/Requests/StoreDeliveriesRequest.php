<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeliveriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bread_id' => 'required|exists:breads,id',
            'user_id' => 'sometimes|exists:users,id',
            'supplier_id' => 'sometimes|exists:suppliers,id',
            'points_of_sales_id' => 'sometimes|exists:points_of_sales,id',    
            'expected_quantity' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'delivery_date' => 'required|date',
        ];
    }
}
