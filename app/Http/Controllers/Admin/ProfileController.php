<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailUpdateRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\UserProfileRequest;
use App\Models\User;
use App\Services\RolePermissionService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $user = User::query()->where("slug", $slug)->first();
        if (!$user){
            abort(404);
        }

        $role = Role::query()->where("id", $user->role_id)->first();

        return view("admin.users.profile.show", compact("user", "role"));
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
        return view("admin.users.profile.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserProfileRequest $request, string $user)
    {
        $data = $request->validated();
        $user = UserService::updateUser($user, $data);
        if ($request->hasFile("image")){
            $this->uploadMedia($user, $request->file("image"));
        }
        if ($user->id != auth()->user()->id){
            return to_route("admin.users.index")->with("success", "Başarılı İşlem");
        }
        return to_route("admin.profile.show", $user->slug)->with("success", "Başarılı İşlem");
    }
    public function uploadMedia($user, $file)
    {
        $user->addMedia($file)
            ->toMediaCollection("user");
    }
    public function updateEmail(EmailUpdateRequest $request)
    {
        $data = $request->validated();

        Auth::user()?->update(['email' => $data['email']]);

        return back()->with('success', 'Başarılı İşlem');
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        $data = $request->validated();

        Auth::user()?->update(['password' => Hash::make($data['new_password'])]);

        return back()->with('success', 'Başarılı İşlem');
    }
    public function resetPassword($slug)
    {
        $user = User::where('slug', $slug)->first();

        if (!$user) {
            abort(404);
        }

        $user->password = Hash::make($user->phone);

        $user->save();

        return back()->with('success', 'Başarılı İşlem');
    }
}
