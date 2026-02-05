<?php

namespace App\Application\UseCases;

use App\Domains\User\Services\AuthDomainService;

class LoginUserUseCase
{
  public function __construct(
    private AuthDomainService $authService
  ) {}

  /**
   * @param string $email
   * @param string $password
   * @return int $userId
   */
  public function execute(string $email, string $password): int
  {
    return $this->authService->authenticate($email, $password);
  }
}
