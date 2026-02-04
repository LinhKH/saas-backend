<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Models\Payment;
use App\Support\Enum\PaymentStatus;
use App\Domains\Payment\Entities\PaymentEntity;
use App\Domains\Payment\Repositories\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{
  private function map(Payment $p): PaymentEntity
  {
    return new PaymentEntity(
      $p->id,
      $p->user_id,
      $p->provider,
      $p->provider_payment_id,
      PaymentStatus::from($p->status),
      $p->amount,
      $p->currency,
      $p->idempotency_key
    );
  }

  public function findByIdempotencyKey(string $key): ?PaymentEntity
  {
    $p = Payment::where('idempotency_key', $key)->first();
    return $p ? $this->map($p) : null;
  }

  public function create(array $data): PaymentEntity
  {
    return $this->map(Payment::create($data));
  }

  public function updateStatus(
    int $id,
    string $status,
    ?string $providerPaymentId = null
  ): PaymentEntity {
    $p = Payment::findOrFail($id);

    $p->update([
      'status' => $status,
      'provider_payment_id' => $providerPaymentId ?? $p->provider_payment_id,
    ]);

    return $this->map($p);
  }
}
