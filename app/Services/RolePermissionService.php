<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionService
{
    public static function getAll(): Collection
    {
        $allData = Role::query()
            ->latest()
            ->get();

        return $allData;
    }
    public static function getByName(string $name)
    {
        $found = Role::query()->where("name", $name)->first();

        return $found;
    }
    public static function getByID(int $id): ?Role
    {
        $found = Role::where("id", $id)->first();
        return $found;
    }
    public static function storeRolePermission(array $data)
    {
        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => $data['name'],
                'guard_name' => 'web'
            ]);

            if (array_key_exists('permissions', $data))
            {
                foreach ($data['permissions'] as $permission)
                {
                    $newPermission = Permission::findOrCreate(
                        $permission,
                        'web'
                    );

                    $role->givePermissionTo($newPermission->name);
                }
            }

            DB::commit();
        }catch (\Exception $e)
        {
            DB::rollBack();
            Log::error($e->getMessage());
        }

    }
    public static function updateRolePermission(int $id, array $data)
    {
        DB::beginTransaction();
        try {
            $role = self::getByID($id);
            if (!$role){
                return false;
            }

            $role->update([
                "name" => $data["name"],
            ]);

            if (array_key_exists('permissions', $data))
            {
                foreach ($data['permissions'] as $permission)
                {
                    Permission::findOrCreate(
                        $permission,
                        'web'
                    );
                }
                $role->syncPermissions($data["permissions"]);
            }else{
                $rolePermission = $role->permissions->pluck("name");
                foreach ($rolePermission as $permission){
                    $role->revokePermissionTo($permission);
                }
            }

            DB::commit();

        }catch (\Exception $e)
        {
            DB::rollBack();
            Log::error($e->getMessage());
        }
    }
}
