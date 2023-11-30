<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }

    public function rules()
    {
        return ['id' => 'required|numeric|exists:categories,id'];
    }

    public function messages()
    {
        return [
            'required' => 'Category is required',
            'numeric' => 'Category is invalid',
            'exists' => 'No Category found'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'status_code' => 404,
                    'message' => $validator->errors()->first(),
                ],
                404
            )
        );
    }
}
