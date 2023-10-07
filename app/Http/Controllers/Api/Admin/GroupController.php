<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Group;
use App\Http\Requests\Admin\StoreGroupRequest;
use App\Http\Requests\Admin\UpdateGroupRequest;

class GroupController extends Controller
{
    public function index()
    {
        return Group::paginate();
    }

    public function store(StoreGroupRequest $request)
    {
        $group = Group::create($request->all());
        return response()->json([
            'success'   => true,
            'message'   => 'Group has been created successfully',
            'data'      => $group
        ], 200);
    }

    public function show(Group $Group)
    {
        return $Group;
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->all());
        return response()->json([
            'success'   => true,
            'message'   => 'Group has been updated successfully',
            'data'      => $group
        ], 200);
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Group has been deleted successfully',
            'data'      => $group
        ], 200);
    }
}
