<?php

namespace App\Services;

use App\Models\Gateway;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GatewayService
{
    public static function getAll(): Collection
    {
        $allData = Gateway::query()
            ->latest()
            ->get();

        return $allData;
    }
    public static function getByName(string $name)
    {
        $found = Gateway::query()->where("name", $name)->first();

        return $found;
    }
    public static function getByID(int $id): ?Gateway
    {
        $found = Gateway::where("id", $id)->first();
        return $found;
    }
    public static function getBySlug(string $slug)
    {
        $data = Gateway::query()->where("slug", $slug)->first();
        return $data;
    }
    public static function storeGateway(array $data)
    {
        dd("store");
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
    public static function updateGateway(int $id, array $data)
    {
        dd("update");
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
