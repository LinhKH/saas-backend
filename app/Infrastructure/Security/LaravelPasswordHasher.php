<?php

namespace App\Infrastructure\Security;

use Illuminate\Support\Facades\Hash;
use App\Domains\User\Services\PasswordHasherInterface;

class LaravelPasswordHasher implements PasswordHasherInterface
{
  public function verify(string $plain, string $hash): bool
  {
    return Hash::check($plain, $hash);
  }
}
