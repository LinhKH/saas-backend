<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Support\Enum\PermissionEnum;

class RolePermissionSeeder extends Seeder
{
  public function run(): void
  {
    $admin = Role::create(['name' => 'admin']);

    foreach (PermissionEnum::cases() as $permission) {
      $perm = Permission::create(['name' => $permission->value]);
      $admin->permissions()->attach($perm);
    }
  }
}
