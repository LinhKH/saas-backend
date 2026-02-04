<?php

namespace App\Support\Enum;

enum PaymentStatus: string
{
  case PENDING = 'pending';
  case SUCCESS = 'success';
  case FAILED  = 'failed';
}
