<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SchoolCategory;
use Illuminate\Http\Request;

class SchoolCategoryController extends Controller
{
    public function index()
    {
        $categories = SchoolCategory::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:school_categories',
        ]);

        $category = SchoolCategory::create($request->all());
        return response()->json($category, 201);
    }

    public function show(SchoolCategory $schoolCategory)
    {
        return response()->json($schoolCategory);
    }

    public function update(Request $request, SchoolCategory $schoolCategory)
    {
        $request->validate([
            'name' => 'required|unique:school_categories,name,' . $schoolCategory->id,
        ]);

        $schoolCategory->update($request->all());
        return response()->json($schoolCategory);
    }

    public function destroy(SchoolCategory $schoolCategory)
    {
        $schoolCategory->delete();
        return response()->json(null, 204);
    }
}
