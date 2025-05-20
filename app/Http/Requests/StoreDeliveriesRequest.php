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
            'point_id' => 'nullable|exists:points_of_sales,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'delivery_date' => 'required|date',
            'quantity' => 'required|numeric|min:0',
            'unit' => ['required', 'string', 'in:kg,litri,pz'],
            'expected_quantity' => 'required|numeric|min:0',
        ];
    }
}
