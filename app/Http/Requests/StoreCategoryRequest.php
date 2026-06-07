<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|string|unique:categories,name',
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'name.unique' => 'Nama kategori sudah ada.',
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