<?php

namespace App\Http\Controllers\Api;

use App\Models\Character;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ShowCharacterRequest;
use App\Http\Requests\StoreCharacterRequest;

class CharacterController extends Controller
{
    function index()
    {
        $characters = Character::all();

        return [
            'status_code' => 200,
            'message' => 'Character list fetched successfully.',
            'data' => $characters
        ];
    }

    function show(ShowCharacterRequest $request)
    {
        $characters = Character::find($request->id);
        return response()->json(
            [
                'status_code' => 200,
                'message' => 'Characters has been found successfully.',
                'data' => $characters
            ],
            200
        );
    }

    // function store(StoreCharacterRequest $request)
    // {
    //     // check is request has image
    //     if ($request->hasFile('image')) {
    //         // create unique filename
    //         $imageName = 'CHARACTER_' . time() . '.' . $request->image->extension();

    //         // store image in APP
    //         $request->file('image')->storeAs('character', $imageName, 'public');
    //     }

    //     $characters = Character::create([
    //         'name' => $request->name,
    //         'brief' => $request->brief,
    //         'type' => $request->type,
    //         'series_id' => $request->series_id,

    //         // store image in database if exists
    //         'image' => $imageName ?? null
    //     ]);

    //     if ($characters) {
    //         return response()->json(
    //             [
    //                 'status_code' => 201,
    //                 'message' => 'Character has been created successfully.',
    //                 'data' => $characters
    //             ],
    //             201
    //         );
    //     } else {
    //         return response()->json(
    //             [
    //                 'status_code' => 400,
    //                 'message' => 'Character create failed.'
    //             ],
    //             400
    //         );
    //     }
    // }

    // function update(Request $request, $id)
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
    //             'title.required' => 'Characters Title can\'t be Empty',

    //             'image.image' => 'Image format has to be PNG or JPEG/JPG',
    //             'image.max' => 'Image is too large',

    //             'category_id.required' => 'Category is required',
    //             'category_id.*' => 'Category is not found'
    //         ]
    //     );

    //     if ($validator->fails()) {
    //         return [
    //             'status_code' => 400,
    //             'message' => $validator->messages()->first()
    //         ];
    //     }

    //     $characters = Character::find($id);

    //     // check is request has image
    //     if ($request->hasFile('image')) {
    //         // create unique filename
    //         $imageName = 'CHARACTERS_' . time() . '.' . $request->image->extension();

    //         // store image in APP
    //         $request->file('image')->storeAs('characters', $imageName, 'public');

    //         // delete old image
    //         Storage::disk('public')->delete('characters/' . $characters->image);
    //     }

    //     $characters->update([
    //         'title' => $request->title ?? $characters->title,
    //         'synopsis' => $request->synopsis ?? $characters->synopsis,
    //         'category_id' => $request->category_id ?? $characters->category_id,

    //         // store image in database if exists, or store the old one
    //         'image' => $imageName ?? $characters->image
    //     ]);

    //     if ($characters) {
    //         return [
    //             'status_code' => 201,
    //             'message' => 'Characters has been updated successfully.',
    //             'data' => $characters
    //         ];
    //     } else {
    //         return [
    //             'status_code' => 400,
    //             'message' => 'Characters update failed.',
    //         ];
    //     }
    // }

    // function destroy($id)
    // {
    //     $validator = Validator::make(
    //         ['id' => $id],
    //         ['id' => 'required|numeric|exists:characters,id'],
    //         [
    //             'id.required' => 'Characters is required',
    //             'id.numeric' => 'Characters ID must be a number',
    //             'id.exists' => 'Characters is not found'
    //         ]
    //     );

    //     if ($validator->fails()) {
    //         return [
    //             'status_code' => 404,
    //             'message' => $validator->messages()->first()
    //         ];
    //     }

    //     $characters = Character::find($id);

    //     // check if characters has image
    //     if ($characters->image) {
    //         // delete iamge if exists
    //         Storage::disk('public')->delete('characters/' . $characters->image);
    //     }

    //     $characters->delete();
    //     if ($characters) {
    //         return [
    //             'status_code' => 201,
    //             'message' => 'Characters has been deleted successfully.',
    //         ];
    //     } else {
    //         return [
    //             'status_code' => 400,
    //             'message' => 'Characters delete failed.',
    //         ];
    //     }
    // }
}
