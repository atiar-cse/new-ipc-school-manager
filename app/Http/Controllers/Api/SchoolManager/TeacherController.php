<?php

namespace App\Http\Controllers\Api\SchoolManager;

use App\Http\Controllers\Controller;
use App\Models\SchoolManager\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Services\ImageUploaderService;
use Auth;

class TeacherController extends Controller
{
    public function index()
    {
        return Teacher::paginate();
    }
    public function store(StoreTeacherRequest $request)
    {
        if ($request->hasFile('teacher_image')) {
            $uploadedImage = $request->file('teacher_image');
            $imagePath = ImageUploaderService::upload($uploadedImage, 'images/teachers');
            $request->merge(['image' => $imagePath]);
        }
        $user_id = 1; //Auth::user()->school->school_id;
        $request->merge(['school_id' => $user_id]);

        $teacher = Teacher::create($request->all());

        return response()->json([
            'success'   => true,
            'message'   => 'Teacher has been created successfully',
            'data'      => $teacher
        ], 200);
    }

    public function show(Teacher $teacher)
    {
        return $teacher;
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        if ($request->hasFile('teacher_image')) {
            $uploadedImage = $request->file('teacher_image');
            $imagePath = ImageUploaderService::upload($uploadedImage, 'images/teachers');
            $request->merge(['image' => $imagePath]);
        }

        $teacher->update($request->all());
        return response()->json([
            'success'   => true,
            'message'   => 'Teacher has been updated successfully',
            'data'      => $teacher
        ], 200);
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Teacher has been deleted successfully',
            'data'      => $teacher
        ], 200);
    }
}
