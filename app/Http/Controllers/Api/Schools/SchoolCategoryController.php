<?php

namespace App\Http\Controllers\Api\Schools;

use App\Http\Controllers\Controller;

use App\Models\Schools\SchoolCategory;
use App\Http\Requests\Schools\StoreSchoolCategoryRequest;
use App\Http\Requests\Schools\UpdateSchoolCategoryRequest;
use Exception;
use GuzzleHttp\Psr7\Message;

class SchoolCategoryController extends Controller
{
    public function index()
    {
        $results = SchoolCategory::all();
        return response()->json(["data" => $results], 200);
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

    public function show($id)
    {
        $result = SchoolCategory::find($id);
        return response()->json(["data" => $result]);
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

    public function destroy($id)
    {
        try {
            $schoolCategory = SchoolCategory::findOrFail($id);
            $schoolCategory->delete();
            return response()->json([
                'success'   => true,
                'message'   => 'School category has been deleted successfully',
                'data'      => $schoolCategory
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Your request has been failed!',
                'exception'   => $e->getMessage(),
            ], 500);
        }
    }
}
