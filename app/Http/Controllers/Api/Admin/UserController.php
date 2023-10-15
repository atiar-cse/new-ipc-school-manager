<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::with('role')->paginate();
    }

    public function store(StoreUserRequest $request)
    {

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->currency_id = $request->currency_id;
        $user->password  = Hash::make($request->password);
        $user->save();

        return response()->json([
            'success'   => true,
            'message'   => 'User has been created successfully',
            'data'      => $user
        ], 200);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->currency_id = $request->currency_id;

        if (!empty($request->password)) {
            $user->password  = Hash::make($request->password);
        }
        $user->save();

        return response()->json([
            'success'   => true,
            'message'   => 'User has been updated successfully',
            'data'      => $user
        ], 200);
    }


    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'User has been deleted successfully',
            'data'      => $user
        ], 200);
    }
}
