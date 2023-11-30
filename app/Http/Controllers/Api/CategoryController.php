<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\GetCategoryRequest;

class CategoryController extends Controller
{
    function index()
    {
        $categories = Category::all();

        return response()->json([
            'status_code' => 200,
            'message' => 'Category list fetched successfully.',
            'data' => $categories
        ], 200);
    }

    function show(GetCategoryRequest $request)
    {
        $category = Category::find($request->id);
        return response()->json([
            'status_code' => 200,
            'message' => 'Category has been found successfully.',
            'data' => $category
        ], 200);
    }
}
