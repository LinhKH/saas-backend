<?php

namespace App\Domains\User\Repositories;

use App\Domains\User\Entities\UserAccount;

// 📌 Domain không biết DB / Eloquent
interface UserAuthRepositoryInterface
{
  public function findByEmail(string $email): ?UserAccount;

  public function increaseLoginAttempts(int $userId): void;

  public function resetLoginAttempts(int $userId): void;

  public function lockUser(int $userId, \DateTimeImmutable $until): void;
}
