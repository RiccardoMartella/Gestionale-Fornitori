<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuppliersRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'points' => 'array',
            'points.*' => 'exists:points_of_sales,id',
            'points.*.name' => 'string|max:255',
            'points.*.address' => 'string|max:255',
            'points.*.phone' => 'string|max:20',
            'points.*.email' => 'email|max:255',
            'points.*.pivot' => 'array',
            'points.*.pivot.point_id' => 'exists:points_of_sales,id',
            'points.*.pivot.supplier_id' => 'exists:suppliers,id',
            'points.*.pivot.created_at' => 'date',      
        ];
    }
}
