<?php

namespace App\Domains\User\Services;

use DomainException;
use App\Domains\User\Repositories\UserAuthRepositoryInterface;

/**
 * 🔥 ĐÂY LÀ AUTH SERVICE ĐÚNG DDD-LITE

Không Laravel

Không Eloquent

Không Hash facade

Test thuần PHP
 */
final class AuthDomainService
{
  public function __construct(
    private UserAuthRepositoryInterface $userRepo,
    private PasswordHasherInterface $hasher
  ) {}

  /**
   * Summary of authenticate
   * @param string $email
   * @param string $password
   * @throws DomainException
   * @return int $userId
   */
  public function authenticate(string $email, string $password): int
  {
    $user = $this->userRepo->findByEmail($email);

    if (!$user) {
      throw new DomainException('Invalid credentials');
    }

    if (!$user->isActive) {
      throw new DomainException('Account inactive');
    }

    if ($user->isLocked()) {
      throw new DomainException('Account locked');
    }

    if (!$this->hasher->verify($password, $user->passwordHash)) {
      $this->handleFailedLogin($user->id, $user->loginAttempts);
      throw new DomainException('Invalid credentials');
    }

    $this->userRepo->resetLoginAttempts($user->id);

    return $user->id;
  }

  private function handleFailedLogin(int $userId, int $attempts): void
  {
    $this->userRepo->increaseLoginAttempts($userId);

    if ($attempts + 1 >= 5) {
      $this->userRepo->lockUser(
        $userId,
        new \DateTimeImmutable('+15 minutes')
      );
    }
  }
}
