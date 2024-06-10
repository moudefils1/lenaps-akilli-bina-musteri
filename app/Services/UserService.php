<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserService
{
    public static function getAll(): Collection
    {
        $users = User::query()
            ->where('id', '!=', 1)
            ->orderByDesc("updated_at")
            ->get();
        return $users;
    }
    public static function storeUser(array $data): User
    {
        $data['created_by'] = auth()->id();
        $data["password"]   = $data["phone"];
        $found = User::create($data);
        return $found;
    }
    public static function updateUser(int $id, array $data): bool|User
    {
        $found = self::getByID($id);
        if (!$found) {
            return false;
        }
        $data['updated_by'] = auth()->id();
        $found->update($data);
        return $found;
    }
    public static function getByID(int $id): ?User
    {
        $found = User::where("id", $id)->first();
        return $found;
    }
    public static function getBySlug(string $slug)
    {
        $found = User::query()->where("slug", $slug)->first();
        return $found;
    }
    public static function getAllRol():Collection
    {
        $found = Role::query()
            ->orderBy("name")
            ->get();
        return $found;
    }
}
