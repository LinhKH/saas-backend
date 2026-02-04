<?php

namespace App\Domains\Payment\Events;

use App\Domains\Payment\Entities\PaymentEntity;

class PaymentSucceeded
{
  public function __construct(
    public PaymentEntity $payment
  ) {}
}
