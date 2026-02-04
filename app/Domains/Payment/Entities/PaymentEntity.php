<?php

namespace App\Domains\Payment\Entities;

use App\Support\Enum\PaymentStatus;

class PaymentEntity
{
  public function __construct(
    public int $id,
    public int $userId,
    public string $provider,
    public ?string $providerPaymentId,
    public PaymentStatus $status,
    public int $amount,
    public string $currency,
    public string $idempotencyKey
  ) {}
}
