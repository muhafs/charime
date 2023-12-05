<?php

namespace App\Http\Controllers\Api;

use App\Models\Series;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Series\SeriesResource;
use App\Http\Requests\Series\GetSeriesRequest;
use App\Http\Requests\Series\StoreSeriesRequest;
use App\Http\Requests\Series\UpdateSeriesRequest;
use App\Http\Resources\Series\SeriesListResource;

class SeriesController extends Controller
{
    function index()
    {
        $series = Series::all();

        return response()->json(
            [
                'status_code' => 200,
                'message' => 'Series list fetched successfully.',
                'data' => SeriesListResource::collection($series)
            ],
            200
        );
    }

    function show(GetSeriesRequest $request)
    {
        $series = Series::with('characters')->find($request->id);
        return response()->json(
            [
                'status_code' => 200,
                'message' => 'Series has been found successfully.',
                'data' => new SeriesResource($series)
            ],
            200
        );
    }

    function store(StoreSeriesRequest $request)
    {
        // check is request has image
        if ($request->hasFile('image')) {
            // create unique filename
            $imageName = 'SERIES_' . time() . '.' . $request->image->extension();

            // store image in APP
            $request->file('image')->storeAs('series', $imageName, 'public');
        }

        $series = Series::create([
            'title' => str()->title($request->title),
            'synopsis' => str()->ucfirst($request->synopsis),
            'category_id' => $request->category_id,

            // store image in database if exists
            'image' => $imageName ?? null
        ]);

        $series->tags()->attach($request->tags);

        if ($series) {
            return response()->json(
                [
                    'status_code' => 201,
                    'message' => 'Series has been created successfully.',
                    'data' => $series
                ],
                201
            );
        } else {
            return response()->json(
                [
                    'status_code' => 400,
                    'message' => 'Series create failed.'
                ],
                400
            );
        }
    }

    function update(UpdateSeriesRequest $request)
    {
        $series = Series::find($request->id);

        // check is request has image
        if ($request->hasFile('image')) {
            // create unique filename
            $imageName = 'SERIES_' . time() . '.' . $request->image->extension();

            // store image in APP
            $request->file('image')->storeAs('series', $imageName, 'public');

            // delete old image
            Storage::disk('public')->delete('series/' . $series->image);
        }

        $series->update([
            'title' => str()->title($request->title ?? $series->title),
            'synopsis' => str()->ucfirst($request->synopsis ?? $series->synopsis),
            'category_id' => $request->category_id ?? $series->category_id,

            // store image in database if exists, or store the old one
            'image' => $imageName ?? $series->image
        ]);

        $series->tags()->sync($request->tags);

        if ($series) {
            return response()->json(
                [
                    'status_code' => 201,
                    'message' => 'Series has been updated successfully.',
                    'data' => $series
                ],
                201
            );
        } else {
            return response()->json(
                [
                    'status_code' => 400,
                    'message' => 'Series update failed.',
                ],
                400
            );
        }
    }

    function destroy(GetSeriesRequest $request)
    {
        $series = Series::find($request->id);

        // check if series has image
        if ($series->image) {
            // delete iamge if exists
            Storage::disk('public')->delete('series/' . $series->image);
        }

        $series->delete();
        if ($series) {
            return response()->json(
                [
                    'status_code' => 201,
                    'message' => 'Series has been deleted successfully.',
                    'data' => $series
                ],
                201
            );
        } else {
            return response()->json(
                [
                    'status_code' => 400,
                    'message' => 'Series delete failed.',
                ],
                400
            );
        }
    }
}
