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

        return [
            'status_code' => 200,
            'message' => 'Category list fetched successfully.',
            'data' => $categories
        ];
    }

    function show(GetCategoryRequest $request)
    {
        $category = Category::find($request->id);
        return [
            'status_code' => 200,
            'message' => 'Category has been found successfully.',
            'data' => $category
        ];
    }
}
