<?php

namespace App\Http\Controllers\Api\SchoolManager;

use App\Http\Controllers\Controller;
use App\Models\SchoolManager\Teacher;
use App\Http\Requests\SchoolManager\StoreTeacherRequest;
use App\Http\Requests\SchoolManager\UpdateTeacherRequest;
use App\Services\ImageUploaderService;
use Auth;

class TeacherController extends Controller
{
    protected $school_id;
    public function __construct()
    {
        $this->school_id = 1; //Auth::user()->school->school_id;
    }

    public function index()
    {
        return Teacher::where('school_id', $this->school_id)->paginate();
    }
    public function getTeachersBySchool()
    {
        return Teacher::where('school_id', $this->school_id)
            ->select('id', 'first_name', 'last_name')
            ->get();
    }

    public function store(StoreTeacherRequest $request)
    {
        if ($request->hasFile('teacher_image')) {
            $uploadedImage = $request->file('teacher_image');
            $imagePath = ImageUploaderService::upload($uploadedImage, 'images/teachers');
            $request->merge(['image' => $imagePath]);
        }

        $request->merge(['school_id' => $this->school_id]);

        $teacher = Teacher::create($request->all());

        return response()->json([
            'success'   => true,
            'message'   => 'Teacher has been created successfully',
            'data'      => $teacher
        ], 200);
    }

    public function show(Teacher $teacher)
    {
        return $teacher->where('school_id', $this->school_id)->firstOrFail();
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
