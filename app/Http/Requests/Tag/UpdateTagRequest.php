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

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }

    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:tags,id',
            'name' => 'required|string|unique:tags,name,' . $this->id,
            'description' => 'nullable|string',
            'category_id' => 'required|numeric|exists:categories,id',

            'series' => 'nullable|array',
            'series.*' => 'sometimes|numeric|exists:series,id|distinct'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Tag is not found',
            'name.required' => 'Tag Name can\'t be Empty',

            'category_id.required' => 'Category is required',
            'category_id.*' => 'Category is not found',

            'series.array' => 'Series is not valid',
            'series.*.distinct' => 'some Series is duplicated',
            'series.*' => 'some Series is not available',
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
