<?php

namespace App\Domains\User\Services;

use App\Models\User;
use App\Support\Enum\PermissionEnum;
use Illuminate\Support\Facades\Cache;

class PermissionService
{
  public function hasPermission(User $user, PermissionEnum $permission): bool
  {
    // if (!$user->role) {
    //   return false;
    // }

    // return $user->role->permissions->contains('name', $permission->value);

    return Cache::remember(
      "user:{$user->id}:permission:{$permission->value}",
      600,
      function () use ($user, $permission) {
        if (!$user->role) {
          return false;
        }

        return $user->role->permissions->contains('name', $permission->value);
      }
    );
  }
}
/**📌 Senior point

Permission logic tập trung 1 chỗ

Dễ cache về sau */
