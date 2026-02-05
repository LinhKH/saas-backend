<?php

namespace App\Domains\User\Entities;

//📌 Entity chỉ chứa trạng thái + rule đơn giản
//✅ Pure DDD: không dùng Carbon, không phụ thuộc thời gian hệ thống
final class UserAccount
{
  public function __construct(
    public readonly int $id,
    public readonly string $email,
    public readonly string $passwordHash,
    public readonly bool $isActive,
    public readonly int $loginAttempts,
    public readonly ?\DateTimeImmutable $lockedUntil
  ) {}

  /**
   * Check if account is locked at a given time
   * @param \DateTimeImmutable $now Current time (injected for testability)
   */
  public function isLockedAt(\DateTimeImmutable $now): bool
  {
    return $this->lockedUntil !== null && $this->lockedUntil > $now;
  }

  /**
   * Convenience method - check if locked right now
   */
  public function isLocked(): bool
  {
    return $this->isLockedAt(new \DateTimeImmutable());
  }
}
