<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\School;
use App\Models\User;
use App\Http\Requests\Admin\StoreSchoolRequest;
use App\Http\Requests\Admin\UpdateSchoolRequest;
use App\Models\Admin\Address;
use App\Models\Admin\MailAddress;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{
    public function index()
    {
        return School::with('group')
            ->paginate();
    }
    public function store(StoreSchoolRequest $request)
    {
        try {
            DB::beginTransaction();
            //user
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->currency_id = $request->currency_id;
            $user->password  = Hash::make($request->password);
            $user->save();
            //school
            $school =  new School;
            $school->name  = $request->school_name;
            $school->position = $request->position;
            $school->user_id  = $user->id;
            $school->group_id = $request->group_id;
            $school->save();
            //address
            $address =  new Address;
            $address->school_id = $school->id;
            $address->address = $request->address;
            $address->address2 = $request->address2;
            $address->city = $request->city;
            $address->zip = $request->zip;
            $address->state = $request->state;
            $address->country = $request->country;
            $address->save();
            //mail address
            $mailing =  new MailAddress;
            $mailing->school_id = $school->id;
            $mailing->address = $request->mailingAddress;
            $mailing->address2 = $request->mailingAddress2;
            $mailing->city = $request->mailingCity;
            $mailing->zip = $request->mailingZip;
            $mailing->state = $request->mailingState;
            $mailing->country = $request->mailingCountry;
            $mailing->save();
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => 'School has been created successfully',
                'data'      => $school
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success'   => false,
                'message'   =>  $e->getMessage(),
                'data'      => $school
            ], 500);
        }
    }
    public function show($id)
    {
        return School::where('id', $id)->with('group', 'address', 'mailaddress', 'user')->first();
    }
    public function update(UpdateSchoolRequest $request, School $school)
    {
        try {

            DB::beginTransaction();
            //user
            $user = User::where('id', $school->user_id)->first();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->currency_id = $request->currency_id;
            $user->password  = Hash::make($request->password);
            $user->save();
            //school 
            $school->name  = $request->school_name;
            $school->position = $request->position;
            $school->group_id = $request->group_id;
            $school->save();
            //address
            $address =  Address::where('school_id', $school->id)->first();
            $address->address = $request->address;
            $address->address2 = $request->address2;
            $address->city = $request->city;
            $address->zip = $request->zip;
            $address->state = $request->state;
            $address->country = $request->country;
            $address->save();
            //mail address
            $mailing =  MailAddress::where('school_id', $school->id)->first();
            $mailing->address = $request->mailingAddress;
            $mailing->address2 = $request->mailingAddress2;
            $mailing->city = $request->mailingCity;
            $mailing->zip = $request->mailingZip;
            $mailing->state = $request->mailingState;
            $mailing->country = $request->mailingCountry;
            $mailing->save();
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => 'School has been updated successfully',
                'data'      => $school
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success'   => false,
                'message'   =>  $e->getMessage(),
                'data'      => $school
            ], 500);
        }
    }

    public function destroy(School $school)
    {
        try {
            $school->user()->delete();
            $school->address()->delete();
            $school->mailaddress()->delete();
            $school->delete();
            return response()->json([
                'success'   => true,
                'message'   => 'School has been deleted successfully',
                'data'      => $school
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success'   => false,
                'message'   =>  $e->getMessage(),
                'data'      => $school
            ], 500);
        }
    }
}
