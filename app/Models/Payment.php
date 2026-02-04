<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $fillable = [
    'user_id',
    'provider',
    'provider_payment_id',
    'status',
    'amount',
    'currency',
    'idempotency_key',
  ];
}
