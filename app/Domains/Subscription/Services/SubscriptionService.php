<?php

namespace App\Domains\Subscription\Services;

use Carbon\Carbon;
use DomainException;
use App\Support\Enum\SubscriptionStatus;
use App\Domains\Subscription\Entities\SubscriptionEntity;

class SubscriptionService
{
  public function activateTrial(int $days = 7): array
  {
    return [
      'status' => SubscriptionStatus::TRIAL->value,
      'started_at' => now(),
      'expired_at' => now()->addDays($days),
    ];
  }

  public function renew(SubscriptionEntity $sub, int $months = 1): array
  {
    if ($sub->status === SubscriptionStatus::CANCELLED) {
      throw new DomainException('Subscription cancelled');
    }

    return [
      'status' => SubscriptionStatus::ACTIVE->value,
      'expired_at' => Carbon::parse($sub->expiredAt)->addMonths($months),
    ];
  }

  public function cancel(): array
  {
    return [
      'status' => SubscriptionStatus::CANCELLED->value,
    ];
  }
}
