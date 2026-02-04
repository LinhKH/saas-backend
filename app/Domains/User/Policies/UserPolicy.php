<?php

namespace App\Domains\User\Policies;

use App\Models\User;
use App\Support\Enum\PermissionEnum;
use App\Domains\User\Services\PermissionService;

class UserPolicy
{
  public function __construct(
    private PermissionService $permissionService
  ) {}

  public function view(User $authUser, User $targetUser): bool
  {
    return $this->permissionService
      ->hasPermission($authUser, PermissionEnum::USER_VIEW);
  }

  public function update(User $authUser, User $targetUser): bool
  {
    return $this->permissionService
      ->hasPermission($authUser, PermissionEnum::USER_UPDATE);
  }

  public function delete(User $authUser, User $targetUser): bool
  {
    return $this->permissionService
      ->hasPermission($authUser, PermissionEnum::USER_DELETE);
  }
}
