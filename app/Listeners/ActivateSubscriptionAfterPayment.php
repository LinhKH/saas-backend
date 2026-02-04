<?php

namespace App\Listeners;

use App\Domains\Payment\Events\PaymentSucceeded;
use App\Application\UseCases\RenewSubscriptionUseCase;

class ActivateSubscriptionAfterPayment
{
  public function __construct(
    private RenewSubscriptionUseCase $useCase
  ) {}

  public function handle(PaymentSucceeded $event): void
  {
    $this->useCase->execute($event->payment->userId);
  }
}
