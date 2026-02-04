<?php

namespace App\Domains\Subscription\Services;

use App\Domains\Subscription\Repositories\SubscriptionRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class SubscriptionCacheService
{
  public function __construct(
    private SubscriptionRepositoryInterface $repo
  ) {}

  public function getByUser(int $userId)
  {
    return Cache::remember(
      "subscription:user:{$userId}",
      300,
      fn() => $this->repo->findByUserId($userId)
    );
  }

  public function clear(int $userId): void
  {
    Cache::forget("subscription:user:{$userId}");
  }
}
