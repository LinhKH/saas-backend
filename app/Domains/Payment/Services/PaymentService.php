<?php

namespace App\Domains\Payment\Services;

use Illuminate\Support\Str;

class PaymentService
{
  public function createIntent(int $amount, string $currency): array
  {
    return [
      'provider_payment_id' => 'mock_' . Str::uuid(),
      'redirect_url' => 'https://mock-pay.test/checkout',
    ];
  }
}
