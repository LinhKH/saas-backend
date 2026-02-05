<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Models\User;
use App\Domains\User\Entities\UserAccount;
use App\Domains\User\Repositories\UserAuthRepositoryInterface;

class EloquentUserAuthRepository implements UserAuthRepositoryInterface
{
  public function findByEmail(string $email): ?UserAccount
  {
    $user = User::where('email', $email)->first();

    if (!$user) return null;

    return new UserAccount(
      $user->id,
      $user->email,
      $user->password,
      $user->is_active,
      $user->login_attempts,
      $user->locked_until
        ? new \DateTimeImmutable($user->locked_until)
        : null
    );
  }

  public function increaseLoginAttempts(int $userId): void
  {
    User::where('id', $userId)->increment('login_attempts');
  }

  public function resetLoginAttempts(int $userId): void
  {
    User::where('id', $userId)->update(['login_attempts' => 0]);
  }

  public function lockUser(int $userId, \DateTimeImmutable $until): void
  {
    User::where('id', $userId)->update([
      'locked_until' => $until,
      'login_attempts' => 0,
    ]);
  }
}
