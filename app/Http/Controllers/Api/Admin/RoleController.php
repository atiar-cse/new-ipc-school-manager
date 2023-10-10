<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Role;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;

class RoleController extends Controller
{
    public function index()
    {
        return Role::paginate();
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->all());
        return response()->json([
            'success'   => true,
            'message'   => 'Role has been created successfully',
            'data'      => $role
        ], 200);
    }

    public function show(Role $role)
    {
        return $role;
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());
        return response()->json([
            'success'   => true,
            'message'   => 'Role has been updated successfully',
            'data'      => $role
        ], 200);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Role has been deleted successfully',
            'data'      => $role
        ], 200);
    }
}
