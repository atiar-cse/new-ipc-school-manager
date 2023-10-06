<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SchoolCategory;
use App\Http\Requests\Admin\StoreSchoolCategoryRequest;
use App\Http\Requests\Admin\UpdateSchoolCategoryRequest;

class SchoolCategoryController extends Controller
{
    public function index()
    {
        return SchoolCategory::paginate();
    }

    public function store(StoreSchoolCategoryRequest $request)
    {
        $category = SchoolCategory::create($request->all());
        return response()->json([
            'success'   => true,
            'message'   => 'School category has been created successfully',
            'data'      => $category
        ], 200);
    }

    public function show(SchoolCategory $schoolCategory)
    {
        return $schoolCategory;
    }

    public function update(UpdateSchoolCategoryRequest $request, SchoolCategory $category)
    {
        $category->update($request->all());
        return response()->json([
            'success'   => true,
            'message'   => 'School category has been updated successfully',
            'data'      => $category
        ], 200);
    }

    public function destroy(SchoolCategory $category)
    {
        $category->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'School category has been deleted successfully',
            'data'      => $category
        ], 200);
    }
}
