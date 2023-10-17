<?php

namespace App\Http\Controllers\Api\SchoolManager;

use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use App\Models\SchoolManager\Family;
use App\Http\Requests\SchoolManager\StoreFamilyRequest;
use App\Http\Requests\SchoolManager\UpdateFamilyRequest;
use Illuminate\Support\Facades\Hash;
use Exception;

class FamilyController extends Controller
{
    protected $user_id;
    public function __construct()
    {
        $this->user_id = 1; //Auth::user()->school->school_id;
    }
    public function index()
    {
        return Family::where('school_id', $this->user_id)->paginate();
    }
    public function store(StoreFamilyRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->currency_id = $request->currency_id;
            $user->password  = Hash::make($request->password);
            $user->save();

            $request->merge(['school_id' => $this->user_id]);
            $family = Family::create($request->all());
            DB::commit();

            return response()->json([
                'success'   => true,
                'message'   => 'Family has been created successfully',
                'data'      => $family
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success'   => false,
                'message'   =>  $e->getMessage(),
                // 'data'      => $book
            ], 500);
        }
    }
    public function show(Family $family)
    {
        return $family->where('school_id', $this->user_id)->first();
    }
    public function update(UpdateFamilyRequest $request, Family $family)
    {
        try {
            DB::beginTransaction();

            $user = User::where('id', $family->user_id)->first();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->currency_id = $request->currency_id;
            $user->password  = Hash::make($request->password);
            $user->save();

            $family->update($request->all());
            DB::commit();

            return response()->json([
                'success'   => true,
                'message'   => 'Family has been updated successfully',
                'data'      => $family
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success'   => false,
                'message'   =>  $e->getMessage(),
                // 'data'      => $book
            ], 500);
        }
    }
    public function destroy(Family $family)
    {
        $family->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Family has been deleted successfully',
            'data'      => $family
        ], 200);
    }
}
