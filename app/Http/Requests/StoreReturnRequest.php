<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReturnRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'bread_id' => 'required|exists:breads,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'point_id' => 'required|exists:points_of_sales,id',
            'quantity' => 'required|numeric|min:0',
            'unit' => ['required', 'string', 'in:kg,litri,pz'],
            'delivery_date' => 'required|date',
        ];
    }
}
