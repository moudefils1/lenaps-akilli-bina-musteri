<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use function Laravel\Prompts\table;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncate();

        /*$data = [
            [
                "name" => "view",
                "guard_name" => "web",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "create",
                "guard_name" => "web",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "update",
                "guard_name" => "web",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "delete",
                "guard_name" => "web",
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];

        Permission::query()->insert($data);*/
    }
    public function truncate()
    {
        Schema::disableForeignKeyConstraints();
        DB::table("roles")->truncate();
        DB::table("permissions")->truncate();
        DB::table("role_has_permissions")->truncate();

    }
}
