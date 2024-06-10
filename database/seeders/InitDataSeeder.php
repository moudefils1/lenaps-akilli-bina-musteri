<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class InitDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncateData();

        Role::insert([
            "name"  =>  "Yönetici",
            "guard_name"  =>  "web",
            "created_at"  =>  now(),
        ]);

        User::create([
            "name"                  =>  "Root",
            "surname"               =>  "Admin",
            "email"                 =>  "test@test.com",
            "password"              =>  "123",
            "email_verified_at"     =>  now(),
            "slug"                  =>  "root-admin",
            "role_id"               =>  "1",
            "status"                =>  "1",
            "phone"                 =>  "0123456789",
            "created_by"            =>  "1",
        ]);
    }
    public function truncateData()
    {
        Schema::disableForeignKeyConstraints();

        DB::table("users")->truncate();
        DB::table("login_logs")->truncate();
        DB::table("roles")->truncate();
        DB::table("permissions")->truncate();
        DB::table("role_has_permissions")->truncate();

        Schema::enableForeignKeyConstraints();
    }
}
