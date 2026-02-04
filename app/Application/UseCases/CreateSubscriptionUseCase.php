<?php

namespace App\Application\UseCases;

use DB;
use App\Domains\Subscription\Services\SubscriptionService;
use App\Domains\Subscription\Repositories\SubscriptionRepositoryInterface;

class CreateSubscriptionUseCase
{
  public function __construct(
    private SubscriptionRepositoryInterface $repo,
    private SubscriptionService $service
  ) {}

  public function execute(int $userId, string $plan)
  {
    return DB::transaction(function () use ($userId, $plan) {
      if ($this->repo->lockByUserId($userId)) {
        throw new \DomainException('Subscription already exists');
      }

      $trial = $this->service->activateTrial();

      return $this->repo->create([
        'user_id' => $userId,
        'plan' => $plan,
        ...$trial,
      ]);
    });
  }
}
