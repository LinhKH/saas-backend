<?php

namespace App\Application\UseCases;

use Str;
use DB;
use App\Domains\Payment\Services\PaymentService;
use App\Domains\Payment\Repositories\PaymentRepositoryInterface;

class CreatePaymentIntentUseCase
{
  public function __construct(
    private PaymentRepositoryInterface $repo,
    private PaymentService $service
  ) {}

  public function execute(int $userId, int $amount, string $currency)
  {
    return DB::transaction(function () use ($userId, $amount, $currency) {
      $key = (string) Str::uuid();

      $intent = $this->service->createIntent($amount, $currency);

      return $this->repo->create([
        'user_id' => $userId,
        'provider' => 'mock',
        'provider_payment_id' => $intent['provider_payment_id'],
        'status' => 'pending',
        'amount' => $amount,
        'currency' => $currency,
        'idempotency_key' => $key,
      ]);
    });
  }
}
