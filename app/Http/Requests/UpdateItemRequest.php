<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:255',
            'quantity' => 'sometimes|required|integer|min:0',
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'sometimes.required' => 'Field ini diperlukan saat diubah.',
        ];
    }

    protected function prepareForValidation()
{
    $input = $this->all();

    array_walk($input, function (&$val) {

        if (is_string($val)) {
            $val = trim(strip_tags($val));
        }

    });

    $this->merge($input);
}
}