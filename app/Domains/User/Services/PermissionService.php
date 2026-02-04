<?php

namespace App\Domains\User\Services;

use App\Models\User;
use App\Support\Enum\PermissionEnum;

class PermissionService
{
  public function hasPermission(User $user, PermissionEnum $permission): bool
  {
    if (!$user->role) {
      return false;
    }

    return $user->role->permissions->contains('name', $permission->value);
  }
}
/**📌 Senior point

Permission logic tập trung 1 chỗ

Dễ cache về sau */
