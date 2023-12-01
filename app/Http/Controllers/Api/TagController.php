<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\GetTagRequest;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;

class TagController extends Controller
{
    function index()
    {
        $tags = Tag::all();

        return response()->json(
            [
                'status_code' => 200,
                'message' => 'Tag list fetched successfully.',
                'data' => $tags
            ],
            200
        );
    }

    function show(GetTagRequest $request)
    {
        $tag = Tag::find($request->id);
        return response()->json(
            [
                'status_code' => 200,
                'message' => 'Tag has been found successfully.',
                'data' => $tag
            ],
            200
        );
    }

    function store(StoreTagRequest $request)
    {
        $tag = Tag::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);

        $tag->series()->attach($request->series);

        if ($tag) {
            return response()->json(
                [
                    'status_code' => 201,
                    'message' => 'Tag has been created successfully.',
                    'data' => $tag
                ],
                201
            );
        } else {
            return response()->json(
                [
                    'status_code' => 400,
                    'message' => 'Tag create failed.'
                ],
                400
            );
        }
    }

    function update(UpdateTagRequest $request)
    {
        $tag = Tag::find($request->id);

        $tag->update([
            'name' => $request->name ?? $tag->name,
            'description' => $request->description ?? $tag->description,
            'category_id' => $request->category_id ?? $tag->category_id,
        ]);

        $tag->series()->sync($request->series);

        if ($tag) {
            return response()->json(
                [
                    'status_code' => 201,
                    'message' => 'Tag has been updated successfully.',
                    'data' => $tag
                ],
                201
            );
        } else {
            return response()->json(
                [
                    'status_code' => 400,
                    'message' => 'Tag update failed.',
                ],
                400
            );
        }
    }

    function destroy(GetTagRequest $request)
    {
        $tag = Tag::destroy($request->id);
        if ($tag) {
            return response()->json(
                [
                    'status_code' => 201,
                    'message' => 'Tag has been deleted successfully.',
                ],
                201
            );
        } else {
            return response()->json(
                [
                    'status_code' => 400,
                    'message' => 'Tag delete failed.',
                ],
                400
            );
        }
    }
}
