<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:products,name'],
            'active' => ['string', 'in:true,false'],
            'description' => ['string', 'nullable'],
            'metadata' => ['array'],
            // 'images' => ['max:8', 'array'],
            // 'images.*' => ['file', 'mimes:png,jpg,jpeg,webp']
            'shippable' => ['string', 'in:true,false'],
            'statement_descriptor' => ['string', 'max:22'],
            'tax_code' => ['string'],
            'unit_label' => ['string'],
            'url' => ['string'],
        ];
    }
}
