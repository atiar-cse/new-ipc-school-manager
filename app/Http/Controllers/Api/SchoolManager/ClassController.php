<?php

namespace App\Http\Controllers\Api\SchoolManager;

use App\Http\Controllers\Controller;

use App\Models\SchoolManager\Classes;
use App\Http\Requests\SchoolManager\StoreClassesRequest;
use App\Http\Requests\SchoolManager\UpdateClassesRequest;
use Exception;
use DB;
use Carbon\Carbon;

class ClassController extends Controller
{
    protected $school_id;
    public function __construct()
    {
        $this->school_id = 1; //Auth::user()->school->school_id;
    }

    public function index()
    {
        return Classes::where('school_id', $this->school_id)->with('teachers')->paginate();
    }

    public function store(StoreClassesRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->merge(['school_id' => $this->school_id]);
            $class = Classes::create($request->all());
            $class_teacher = [];
            if ($request->has('teacher_ids')) {
                if ($request->input('teacher_ids')) {
                    foreach ($request->input('teacher_ids') as $teacher_id) {
                        $class_teacher[] = [
                            'class_id' => $class->id,
                            'teacher_id' => $teacher_id
                        ];
                    }
                }
            }
            if (!empty($class_teacher)) {
                DB::table('class_teacher')->insert($class_teacher);
            }
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => 'Class has been created successfully',
                'data'      => $class
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success'   => false,
                'message'   =>  $e->getMessage(),
            ], 500);
        }
    }

    public function show(Classes $classes)
    {
        //
    }
    public function update(UpdateClassesRequest $request, Classes $classes)
    {
        //
    }
    public function destroy(Classes $classes)
    {
        //
    }
}
