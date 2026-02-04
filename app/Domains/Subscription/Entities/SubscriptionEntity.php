<?php

namespace App\Domains\Subscription\Entities;

use App\Support\Enum\SubscriptionStatus;
use Carbon\Carbon;

class SubscriptionEntity
{
  public function __construct(
    public int $id,
    public int $userId,
    public string $plan,
    public SubscriptionStatus $status,
    public ?Carbon $startedAt,
    public ?Carbon $expiredAt
  ) {}

  public function isActive(): bool
  {
    return $this->status === SubscriptionStatus::ACTIVE
      && $this->expiredAt?->isFuture();
  }

  // Có thể có thêm:
  // public function renew() { ... }
  // public function cancel() { ... }
  // public function upgrade($newPlan) { ... }
}
