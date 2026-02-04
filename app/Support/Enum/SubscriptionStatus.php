<?php

namespace App\Support\Enum;

enum SubscriptionStatus: string
{
  case TRIAL = 'trial';
  case ACTIVE = 'active';
  case EXPIRED = 'expired';
  case CANCELLED = 'cancelled';
}
