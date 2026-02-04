<?php

namespace App\Application\UseCases;

use DB;
use App\Domains\Subscription\Services\SubscriptionService;
use App\Domains\Subscription\Repositories\SubscriptionRepositoryInterface;
use App\Domains\Subscription\Services\SubscriptionCacheService;

class RenewSubscriptionUseCase
{
  public function __construct(
    private SubscriptionRepositoryInterface $repo,
    private SubscriptionService $service,
    private SubscriptionCacheService $cacheService
  ) {}

  public function execute(int $userId)
  {
    return DB::transaction(function () use ($userId) {
      $sub = $this->repo->lockByUserId($userId);

      if (!$sub) {
        throw new \DomainException('No subscription');
      }

      $data = $this->service->renew($sub);
      $this->cacheService->clear($userId);

      return $this->repo->update($sub->id, $data);
    });
  }
}
