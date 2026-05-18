<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getAllRoles(Request $request)
    {
        $roles = Role::latest()->get();
        return APIResponse::success('Roles fetched successfully', $roles);
    }

    public function createRolePage(Request $request)
    {
        return response()->view('roles.create');
    }

    public function createRole(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        return APIResponse::success(
            'Role created successfully',
            $role,
            201
        );
    }

    public function editRole(Request $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            abort(404);
        }

        return response()->view(
            'roles.edit',
            compact('role')
        );
    }

    public function updateRole(Request $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {

            return APIResponse::error(
                'Role not found',
                [],
                404
            );
        }

        $request->validate([
            'name' => "required|unique:roles,name,$id",
        ]);

        $role->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->is_active,
        ]);

        return APIResponse::success(
            'Role updated successfully',
            $role
        );
    }

    public function deleteRole(Request $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {

            return APIResponse::error(
                'Role not found',
                [],
                404
            );
        }

        $role->delete();

        return APIResponse::success(
            'Role deleted successfully'
        );
    }
}