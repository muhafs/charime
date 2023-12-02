<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Requests\Category\GetCategoryRequest;
use App\Http\Resources\Category\CategoryListResource;

class CategoryController extends Controller
{
    function index()
    {
        $categories = Category::all();

        return response()->json([
            'status_code' => 200,
            'message' => 'Category list fetched successfully.',
            'data' => CategoryListResource::collection($categories)
        ], 200);
    }

    function show(GetCategoryRequest $request)
    {
        $category = Category::with('tags', 'series')->find($request->id);
        return response()->json([
            'status_code' => 200,
            'message' => 'Category has been found successfully.',
            'data' => new CategoryResource($category)
        ], 200);
    }
}
