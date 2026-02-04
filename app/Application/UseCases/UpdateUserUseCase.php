<?php

namespace App\Application\UseCases;

use App\Models\User;
use App\Domains\AuditLog\Services\AuditService;

class UpdateUserUseCase
{
  public function __construct(
    private AuditService $auditService
  ) {}

  public function execute(User $targetUser, array $data): User
  {
    $targetUser->update($data);

    $this->auditService->log(
      auth()->id(),
      'user.updated',
      [
        'target_user_id' => $targetUser->id,
        'changes' => array_keys($data),
      ]
    );

    return $targetUser;
  }
}
