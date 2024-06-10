<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncateData();

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
        DB::table("users")->truncate();
        DB::table("login_logs")->truncate();
    }
}
