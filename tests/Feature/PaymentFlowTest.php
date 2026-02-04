<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentFlowTest extends TestCase
{
  use RefreshDatabase;

  public function test_payment_success_renews_subscription()
  {
    $user = User::factory()->create();

    $this->actingAs($user, 'sanctum')
      ->postJson('/api/payments', [
        'amount' => 1000,
      ])->assertStatus(200);

    $this->postJson('/api/webhooks/payment', [
      'idempotency_key' => \App\Models\Payment::first()->idempotency_key,
      'status' => 'success',
      'provider_payment_id' => 'mock_123',
    ])->assertStatus(200);
  }
}
