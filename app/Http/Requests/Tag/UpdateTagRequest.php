<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTagRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:tags,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'category_id' => 'required|numeric|exists:categories,id'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Tag is not found',
            'name.required' => 'Tag Name can\'t be Empty',

            'category_id.required' => 'Category is required',
            'category_id.*' => 'Category is not found'
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
