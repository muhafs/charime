<?php

namespace App\Http\Controllers\Api;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SeriesController extends Controller
{
    function index()
    {
        $series = Series::all();

        return [
            'status_code' => 200,
            'message' => 'Series list fetched successfully.',
            'data' => $series
        ];
    }

    function show($id)
    {
        $validator = Validator::make(
            ['id' => $id],
            ['id' => 'required|numeric|exists:series,id'],
            [
                'required' => 'Series ID required',
                'numeric' => 'Series ID must be a number',
                'exists' => 'No Series found',
            ]
        );

        if ($validator->fails()) {
            return [
                'status_code' => 404,
                'message' => $validator->messages()->first()
            ];
        }

        $series = Series::find($id);
        return [
            'status_code' => 200,
            'message' => 'Series has been found successfully.',
            'data' => $series
        ];
    }

    // function store(Request $request)
    // {
    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //             'title' => 'required|string',
    //             'synopsis' => 'nullable|string',
    //             'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
    //             'category_id' => 'required|numeric|exists:categories,id'
    //         ],
    //         [
    //             'name.required' => 'Series Name can\'t be Empty',
    //             'name.unique' => 'This name has already taken',

    //             'image.image' => 'Image format has to be PNG or JPEG/JPG',
    //             'image.max' => 'Image is too large',

    //             'category_id.required' => 'Category is required',
    //             'category_id.numeric' => 'Category ID must be a number',
    //             'category_id.exists' => 'Category is not found'
    //         ]
    //     );

    //     if ($validator->fails()) {
    //         return [
    //             'status_code' => 400,
    //             'message' => $validator->messages()->first()
    //         ];
    //     }

    //     // check is request has image
    //     if ($request->hasFile('image')) {
    //         // create unique filename
    //         $imageName = 'SERIES_' . time() . '.' . $request->image->extension();

    //         // store image in APP
    //         $request->file('image')->storeAs('series', $imageName, 'public');
    //     }

    //     $series = Series::create([
    //         'title' => $request->title,
    //         'synopsis' => $request->synopsis,
    //         'category_id' => $request->category_id,
    //         // store image in database if exists
    //         'image' => $imageName ?? null
    //     ]);

    //     if ($series) {
    //         return [
    //             'status_code' => 201,
    //             'message' => 'Series has been created successfully.',
    //             'data' => $series
    //         ];
    //     } else {
    //         return [
    //             'status_code' => 400,
    //             'message' => 'Series create failed.',
    //         ];
    //     }
    // }

    // function update(Request $request, $id)
    // {
    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //             'name' => 'required|string|unique:series,name,' . $id,
    //             'description' => 'nullable|string',
    //             'category_id' => 'required|numeric|exists:categories,id'
    //         ],
    //         [
    //             'name.required' => 'Series name can\'t be Empty',
    //             'name.unique' => 'This name has already taken',

    //             'category_id.required' => 'Category is required',
    //             'category_id.numeric' => 'Category ID must be a number',
    //             'category_id.exists' => 'Category is not found'
    //         ]
    //     );

    //     if ($validator->fails()) {
    //         return [
    //             'status_code' => 400,
    //             'message' => $validator->messages()->first()
    //         ];
    //     }

    //     $series = Series::find($id);
    //     $series->update([
    //         'name' => $request->name ?? $series->name,
    //         'description' => $request->description ?? $series->description,
    //         'category_id' => $request->category_id ?? $series->category_id
    //     ]);

    //     if ($series) {
    //         return [
    //             'status_code' => 201,
    //             'message' => 'Series has been updated successfully.',
    //             'data' => $series
    //         ];
    //     } else {
    //         return [
    //             'status_code' => 400,
    //             'message' => 'Series update failed.',
    //         ];
    //     }
    // }

    // function destroy($id)
    // {
    //     $validator = Validator::make(
    //         ['id' => $id],
    //         ['id' => 'required|numeric|exists:series,id'],
    //         [
    //             'id.required' => 'Series is required',
    //             'id.numeric' => 'Series ID must be a number',
    //             'id.exists' => 'Series is not found'
    //         ]
    //     );

    //     if ($validator->fails()) {
    //         return [
    //             'status_code' => 404,
    //             'message' => $validator->messages()->first()
    //         ];
    //     }

    //     $series = Series::destroy($id);
    //     if ($series) {
    //         return [
    //             'status_code' => 201,
    //             'message' => 'Series has been deleted successfully.',
    //         ];
    //     } else {
    //         return [
    //             'status_code' => 400,
    //             'message' => 'Series delete failed.',
    //         ];
    //     }
    // }
}
