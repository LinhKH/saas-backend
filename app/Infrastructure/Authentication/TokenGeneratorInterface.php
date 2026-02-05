<?php

namespace App\Infrastructure\Authentication;

/**
 * 📌 Interface cho token generation
 * Không thuộc Domain (vì token là infrastructure concern)
 */
interface TokenGeneratorInterface
{
  public function generateForUser(int $userId): string;
}
