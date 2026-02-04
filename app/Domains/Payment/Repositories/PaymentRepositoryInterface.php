<?php

namespace App\Domains\Payment\Repositories;

use App\Domains\Payment\Entities\PaymentEntity;

interface PaymentRepositoryInterface
{
  public function findByIdempotencyKey(string $key): ?PaymentEntity;

  public function create(array $data): PaymentEntity;

  public function updateStatus(
    int $id,
    string $status,
    ?string $providerPaymentId = null
  ): PaymentEntity;
}
