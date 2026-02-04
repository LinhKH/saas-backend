<?php

namespace App\Domains\AuditLog\Services;

use App\Models\AuditLog;

class AuditService
{
  public function log(?int $userId, string $action, array $data = []): void
  {
    AuditLog::create([
      'user_id' => $userId,
      'action'  => $action,
      'data'    => $data,
    ]);
  }
}
