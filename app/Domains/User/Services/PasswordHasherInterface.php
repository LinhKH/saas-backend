<?php

namespace App\Domains\User\Services;

/**
 * 📌 Cực kỳ quan trọng
→ Domain không phụ thuộc Hash::check()
 */
interface PasswordHasherInterface
{
  public function verify(string $plain, string $hash): bool;
}
