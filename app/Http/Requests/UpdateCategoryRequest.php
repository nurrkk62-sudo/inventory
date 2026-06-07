<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        $id = $this->route('category');

        return [
            'name' => "required|string|unique:categories,name,{$id}",
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