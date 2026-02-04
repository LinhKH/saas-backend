<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Support\Enum\SubscriptionStatus;
use App\Domains\Subscription\Services\SubscriptionService;
use App\Domains\Subscription\Entities\SubscriptionEntity;

class SubscriptionServiceTest extends TestCase
{
  public function test_renew_subscription()
  {
    $service = new SubscriptionService();

    $sub = new SubscriptionEntity(
      1,
      1,
      'pro',
      SubscriptionStatus::ACTIVE,
      now(),
      now()->addDay()
    );

    $data = $service->renew($sub);

    $this->assertEquals(
      SubscriptionStatus::ACTIVE->value,
      $data['status']
    );
  }
}
