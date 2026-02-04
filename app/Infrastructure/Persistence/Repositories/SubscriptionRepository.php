<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Models\Subscription;
use App\Support\Enum\SubscriptionStatus;
use App\Domains\Subscription\Entities\SubscriptionEntity;
use App\Domains\Subscription\Repositories\SubscriptionRepositoryInterface;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
  private function map(Subscription $sub): SubscriptionEntity
  {
    return new SubscriptionEntity(
      $sub->id,
      $sub->user_id,
      $sub->plan,
      SubscriptionStatus::from($sub->status),
      $sub->started_at,
      $sub->expired_at
    );
  }

  public function findByUserId(int $userId): ?SubscriptionEntity
  {
    $sub = Subscription::where('user_id', $userId)->first();
    return $sub ? $this->map($sub) : null;
  }

  public function lockByUserId(int $userId): ?SubscriptionEntity
  {
    $sub = Subscription::where('user_id', $userId)
      ->lockForUpdate()
      ->first();

    return $sub ? $this->map($sub) : null;
  }

  public function create(array $data): SubscriptionEntity
  {
    return $this->map(Subscription::create($data));
  }

  public function update(int $id, array $data): SubscriptionEntity
  {
    $sub = Subscription::findOrFail($id);
    $sub->update($data);
    return $this->map($sub);
  }
}
