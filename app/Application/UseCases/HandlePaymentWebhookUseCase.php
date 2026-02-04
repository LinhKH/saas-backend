<?php

namespace App\Application\UseCases;

use DB;
use Event;
use App\Support\Enum\PaymentStatus;
use App\Domains\Payment\Events\PaymentSucceeded;
use App\Domains\Payment\Repositories\PaymentRepositoryInterface;

class HandlePaymentWebhookUseCase
{
  public function __construct(
    private PaymentRepositoryInterface $repo
  ) {}

  //📌 Đây là chỗ phỏng vấn senior hay hỏi nhất
  public function execute(array $payload): void
  {
    DB::transaction(function () use ($payload) {
      $payment = $this->repo->findByIdempotencyKey($payload['idempotency_key']);

      if (!$payment) {
        return;
      }

      // IDMPOTENT: đã success thì bỏ qua
      if ($payment->status === PaymentStatus::SUCCESS) {
        return; // webhook bắn lại 10 lần cũng k sao 👉 Đây là điều Stripe / GMO yêu cầu
      }

      if ($payload['status'] === 'success') {
        $updated = $this->repo->updateStatus(
          $payment->id,
          PaymentStatus::SUCCESS->value,
          $payload['provider_payment_id']
        );

        event(new PaymentSucceeded($updated));
      } else {
        $this->repo->updateStatus(
          $payment->id,
          PaymentStatus::FAILED->value
        );
      }
    });
  }
}
