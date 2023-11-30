<?php

namespace App\Http\Requests\Character;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCharacterRequest extends FormRequest
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
            'id' => 'required|numeric|exists:characters,id',
            'name' => 'required|string',
            'brief' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'type' => 'required|string|in:HERO,MAIN,SUB',
            'series_id' => 'required|numeric|exists:series,id'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Character is not found',
            'name.required' => 'Character Name can\'t be Empty',

            'image.image' => 'Image format has to be PNG or JPEG/JPG',
            'image.max' => 'Image is too large',

            'type.required' => 'Type is missing',
            'type.in' => 'Type is invalid',

            'series_id.required' => 'Series is required',
            'series_id.*' => 'Series is not found'
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
