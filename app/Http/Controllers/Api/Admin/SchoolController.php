<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\School;
use App\Http\Requests\Admin\StoreSchoolRequest;
use App\Http\Requests\Admin\UpdateSchoolRequest;

class SchoolController extends Controller
{
    public function index()
    {
        return School::with('address', 'mailaddress')
            ->paginate();
    }
    public function store(StoreSchoolRequest $request)
    {
        $school = School::create($request->all());
        return response()->json([
            'success'   => true,
            'message'   => 'School has been created successfully',
            'data'      => $school
        ], 200);
    }
    public function show(School $school)
    {
        return $school;
    }
    public function update(UpdateSchoolRequest $request, School $school)
    {
        $school->update($request->all());
        return response()->json([
            'success'   => true,
            'message'   => 'School has been updated successfully',
            'data'      => $school
        ], 200);
    }
    /*
    public function destroy(School $school)
    {
        $school->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'School has been deleted successfully',
            'data'      => $school
        ], 200);
    }
    */
}
