<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = UserService::getAll();

        return view("admin.users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = UserService::getAllRol();
        return view("admin.users.add", compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = UserService::storeUser($data);

        if ($request->hasFile("image")){
            $this->uploadMedia($user, $request->file("image"));
        }

        return to_route("admin.users.index")->with("success", "Başarılı İşlem");
    }
    public function uploadMedia($user, $file)
    {
        $user->addMedia($file)
            ->toMediaCollection("user");
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $user = UserService::getBySlug($slug);

        if (!$user){
            abort(404);
        }

        return view("admin.users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $user = UserService::getBySlug($slug);

        if (!$user){
            abort(404);
        }

        $roles = UserService::getAllRol();

        return view("admin.users.edit", compact("user", "roles"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $user)
    {
        $data = $request->validated();
        $user = UserService::updateUser($user, $data);

        if ($request->hasFile("image")){
            $this->uploadMedia($user, $request->file("image"));
        }

        if ($user->id != auth()->user()->id){
            return to_route("admin.users.index")->with("success", "Başarılı İşlem");
        }

        return to_route("admin.users.profile", $user->slug)->with("success", "Başarılı İşlem");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with("success", "Opération réussie");
    }
    public function softDeletedUsers()
    {
        $deletedUsers = User::onlyTrashed()->whereNotNull('deleted_at')->get();

        if ($deletedUsers->isNotEmpty()) {
            if (!$deletedUsers){
                abort(404);
            }
        }

        return view("admin.users.soft_deleted_users.index", compact("deletedUsers"));
    }
    public function restore($slug)
    {
        $restoredUser = User::onlyTrashed()->where('slug', $slug)->firstOrFail();
        $restoredUser->restore();

        return to_route("admin.users.soft.deleted")->with("succes", "Opération réussie");
    }
}
