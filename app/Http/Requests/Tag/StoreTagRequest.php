<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTagRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|unique:tags,name',
            'description' => 'nullable|string',
            'category_id' => 'required|numeric|exists:categories,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tag Name can\'t be Empty',
            'name.unique' => 'This name has already taken',

            'category_id.required' => 'Category is required',
            'category_id.numeric' => 'Category ID must be a number',
            'category_id.exists' => 'Category is not found'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'status_code' => 400,
                    'message' => $validator->errors()->first(),
                ],
                400
            )
        );
    }
}
