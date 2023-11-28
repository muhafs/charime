<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    function index()
    {
        $tags = Tag::all();

        return [
            'status_code' => 200,
            'message' => 'Tag list fetched successfully.',
            'data' => $tags
        ];
    }

    function show($id)
    {
        $validator = Validator::make(
            ['id' => $id],
            ['id' => 'required|numeric|exists:tags,id'],
            [
                'required' => 'Tag ID required',
                'numeric' => 'Tag ID must be a number',
                'exists' => 'No Tag found',
            ]
        );

        if ($validator->fails()) {
            return [
                'status_code' => 404,
                'message' => $validator->messages()->first()
            ];
        }

        $tag = Tag::find($id);
        return [
            'status_code' => 200,
            'message' => 'Tag has been found successfully.',
            'data' => $tag
        ];
    }

    function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|unique:tags,name',
                'description' => 'nullable|string',
                'category_id' => 'required|numeric|exists:categories,id'
            ],
            [
                'name.required' => 'Tag Name is required',
                'name.unique' => 'This name has already taken',

                'category_id.required' => 'Category is required',
                'category_id.numeric' => 'Category ID must be a number',
                'category_id.exists' => 'Category is not found'
            ]
        );

        if ($validator->fails()) {
            return [
                'status_code' => 404,
                'message' => $validator->messages()->first()
            ];
        }

        $tag = Tag::create($request->all());
        if ($tag) {
            return [
                'status_code' => 201,
                'message' => 'Tag has been created successfully.',
                'data' => $tag
            ];
        } else {
            return [
                'status_code' => 400,
                'message' => 'Tag create failed.',
            ];
        }
    }
}
