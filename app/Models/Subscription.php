<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
  protected $fillable = [
    'user_id',
    'plan',
    'status',
    'started_at',
    'expired_at',
  ];

  protected $casts = [
    'started_at' => 'datetime',
    'expired_at' => 'datetime',
  ];
}
