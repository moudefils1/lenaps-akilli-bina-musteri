<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("surname", 255)->after("name");
            $table->string("slug")->unique()->after("surname");
            $table->tinyInteger("role_id")->after("remember_token");
            $table->bigInteger("phone")->after("role_id");
            $table->string("address", 255)->nullable()->after("phone");
            $table->tinyInteger("status")->default(1)->after("address");
            $table->bigInteger("created_by")->after("status");
            $table->bigInteger("updated_by")->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                    "surname", "slug", "role", "phone", "address",
                    "status", "created_by", "updated_by", "deleted_at"
                ]);
        });
    }
};
