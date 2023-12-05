<?php

namespace App\Http\Controllers\Api;

use App\Models\Character;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Character\GetCharacterRequest;
use App\Http\Requests\Character\StoreCharacterRequest;
use App\Http\Requests\Character\UpdateCharacterRequest;

class CharacterController extends Controller
{
    function index()
    {
        $characters = Character::all();

        return response()->json(
            [
                'status_code' => 200,
                'message' => 'Character list fetched successfully.',
                'data' => $characters
            ],
            200
        );
    }

    function show(GetCharacterRequest $request)
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
            'name' => str()->title($request->name),
            'brief' => str()->ucfirst($request->brief),
            'type' => str()->upper($request->type),
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
            'name' => str()->title($request->name ?? $character->name),
            'brief' => str()->ucfirst($request->brief ?? $character->brief),
            'type' => str()->upper($request->type ?? $character->type),
            'series_id' => $request->series_id ?? $character->series_id,

            // store image in database if exists, or store the old one
            'image' => $imageName ?? $character->image
        ]);

        if ($character) {
            return response()->json([
                'status_code' => 201,
                'message' => 'Character has been updated successfully.',
                'data' => $character
            ], 201);
        } else {
            return response()->json([
                'status_code' => 400,
                'message' => 'Characters update failed.',
            ], 400);
        }
    }

    function destroy(GetCharacterRequest $request)
    {
        $character = Character::find($request->id);

        // check if character has image
        if ($character->image) {
            // delete iamge if exists
            Storage::disk('public')->delete('character/' . $character->image);
        }

        $character->delete();
        if ($character) {
            return response()->json([
                'status_code' => 201,
                'message' => 'Character has been deleted successfully.',
            ], 201);
        } else {
            return response()->json([
                'status_code' => 400,
                'message' => 'Character delete failed.',
            ], 400);
        }
    }
}
