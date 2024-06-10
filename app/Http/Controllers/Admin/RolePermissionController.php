<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermissionRequest;
use App\Http\Requests\UpdateRolePermissionRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\RolePermissionService;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = RolePermissionService::getAll();

        /*foreach ($roles as $role){
            $users = User::where("role_id", $role->id)->get();
        }*/

        $rolesWithUsers = [];

        foreach ($roles as $role){
            $users = User::where("role_id", $role->id)->get();
            $rolesWithUsers[] = [
                'role' => $role,
                'users' => $users
            ];
        }

        return view("admin.roles.index", compact("roles", "rolesWithUsers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.roles.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolePermissionRequest $request)
    {
        $data = $request->validated();

        RolePermissionService::storeRolePermission($data);

        return to_route("admin.role-permissions.index")->with("success", "Başarılı İşlem");
    }

    /**
     * Display the specified resource.
     */
    public function show($name)
    {
        $role = RolePermissionService::getByName($name);

        if (!$role){
            abort(404);
        }

        return view("admin.roles.show", compact("role"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($name)
    {
        $role = RolePermissionService::getByName($name);

        if (!$role){
            abort(404);
        }

        return view("admin.roles.edit", compact("role"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRolePermissionRequest $request, $role)
    {
        $data = $request->validated();

        RolePermissionService::updateRolePermission($role, $data);

        return to_route("admin.role-permissions.index")->with("success", "Başarılı İşlem");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($role)
    {
        $role = \Spatie\Permission\Models\Role::where("id", $role)?->first();

        if (!$role){
            abort(404);
        }

        $role->delete();

        return back()->with("Başarılı İşlem");
    }
}
