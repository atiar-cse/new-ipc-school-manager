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
        $schoolCategory = SchoolCategory::create($request->all());
        return response()->json([
            'success'   => true,
            'message'   => 'School category has been created successfully',
            'data'      => $schoolCategory
        ], 200);
    }

    public function show(SchoolCategory $schoolCategory)
    {
        return $schoolCategory;
    }

    public function update(UpdateSchoolCategoryRequest $request, SchoolCategory $schoolCategory)
    {
        $schoolCategory->update($request->all());
        return response()->json([
            'success'   => true,
            'message'   => 'School category has been updated successfully',
            'data'      => $schoolCategory
        ], 200);
    }

    public function destroy(SchoolCategory $schoolCategory)
    {
        $schoolCategory->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'School category has been deleted successfully',
            'data'      => $schoolCategory
        ], 200);
    }
}
