<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $role1 = Role::create(['name'=>'master']);
        $role2 = Role::create(['name'=>'employee']);
        $user = User::find(3);
        $user->assignRole($role1);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
