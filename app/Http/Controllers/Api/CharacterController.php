<?php

namespace App\Http\Controllers\Api;

use App\Models\Character;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ShowCharacterRequest;
use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;

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

    function store(StoreCharacterRequest $request)
    {
        // check is request has image
        if ($request->hasFile('image')) {
            // create unique filename
            $imageName = 'CHARACTER_' . time() . '.' . $request->image->extension();

            // store image in APP
            $request->file('image')->storeAs('character', $imageName, 'public');
        }

        $characters = Character::create([
            'name' => $request->name,
            'brief' => $request->brief,
            'type' => $request->type,
            'series_id' => $request->series_id,

            // store image in database if exists
            'image' => $imageName ?? null
        ]);

        if ($characters) {
            return response()->json(
                [
                    'status_code' => 201,
                    'message' => 'Character has been created successfully.',
                    'data' => $characters
                ],
                201
            );
        } else {
            return response()->json(
                [
                    'status_code' => 400,
                    'message' => 'Character create failed.'
                ],
                400
            );
        }
    }

    function update(UpdateCharacterRequest $request, $id)
    {
        $character = Character::find($id);

        // check is request has image
        if ($request->hasFile('image')) {
            // create unique filename
            $imageName = 'CHARACTER_' . time() . '.' . $request->image->extension();

            // store image in APP
            $request->file('image')->storeAs('character', $imageName, 'public');

            // delete old image
            Storage::disk('public')->delete('character/' . $character->image);
        }

        $character->update([
            'name' => $request->name ?? $character->name,
            'brief' => $request->brief ?? $character->brief,
            'type' => $request->type ?? $character->type,
            'series_id' => $request->series_id ?? $character->series_id,

            // store image in database if exists, or store the old one
            'image' => $imageName ?? $character->image
        ]);

        if ($character) {
            return [
                'status_code' => 201,
                'message' => 'Character has been updated successfully.',
                'data' => $character
            ];
        } else {
            return [
                'status_code' => 400,
                'message' => 'Characters update failed.',
            ];
        }
    }

    // function destroy(ShowCharacterRequest $request)
    // {
    //     $character = Character::find($request->id);

    //     // check if character has image
    //     if ($character->image) {
    //         // delete iamge if exists
    //         Storage::disk('public')->delete('character/' . $character->image);
    //     }

    //     $character->delete();
    //     if ($character) {
    //         return [
    //             'status_code' => 201,
    //             'message' => 'Character has been deleted successfully.',
    //         ];
    //     } else {
    //         return [
    //             'status_code' => 400,
    //             'message' => 'Character delete failed.',
    //         ];
    //     }
    // }
}
