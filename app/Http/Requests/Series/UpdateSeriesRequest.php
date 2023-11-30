<?php

namespace App\Http\Requests\Series;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateSeriesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:series,id',
            'title' => 'required|string',
            'synopsis' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required|numeric|exists:categories,id'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Series is not found',
            'title.required' => 'Series Title can\'t be Empty',

            'image.image' => 'Image format has to be PNG or JPEG/JPG',
            'image.max' => 'Image is too large',

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
