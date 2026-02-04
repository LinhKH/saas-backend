<?php

namespace App\Domains\User\Entities;

/**
📌 Senior mindset
Entity ≠ Eloquent model
→ Entity là business representation
 */
class UserEntity
{
  public function __construct(
    public int $id,
    public string $email,
    public string $name,
    public bool $isActive
  ) {}
}
