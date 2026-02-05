<?php

namespace App\Infrastructure\Authentication;

use App\Models\User;

/**
 * 📌 Sanctum implementation của TokenGenerator
 * Cô lập Laravel Sanctum logic
 */
final class SanctumTokenGenerator implements TokenGeneratorInterface
{
  public function generateForUser(int $userId): string
  {
    $user = User::findOrFail($userId);

    return $user->createToken('api')->plainTextToken;
  }
}
