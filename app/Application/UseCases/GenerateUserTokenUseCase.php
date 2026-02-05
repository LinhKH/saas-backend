<?php

namespace App\Application\UseCases;

use App\Infrastructure\Authentication\TokenGeneratorInterface;

/**
 * 📌 Use Case cho token generation
 * Tách riêng khỏi login logic (Single Responsibility)
 */
final class GenerateUserTokenUseCase
{
  public function __construct(
    private TokenGeneratorInterface $tokenGenerator
  ) {}

  public function execute(int $userId): string
  {
    return $this->tokenGenerator->generateForUser($userId);
  }
}
