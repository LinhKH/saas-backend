<?php

namespace App\Domains\Subscription\Repositories;

use App\Domains\Subscription\Entities\SubscriptionEntity;

interface SubscriptionRepositoryInterface
{
  public function findByUserId(int $userId): ?SubscriptionEntity;

  public function create(array $data): SubscriptionEntity;

  public function update(int $id, array $data): SubscriptionEntity;

  public function lockByUserId(int $userId): ?SubscriptionEntity;
}
