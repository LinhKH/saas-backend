<?php

namespace App\Application\UseCases;

use App\Domains\User\Services\AuthService;

class LoginUserUseCase
{
  public function __construct(
    private AuthService $authService
  ) {}

  public function execute(string $email, string $password): array
  {
    $user = $this->authService->authenticate($email, $password);

    $token = $user->createToken('api-token')->plainTextToken;

    return [
      'token' => $token,
      'user' => [
        'id' => $user->id,
        'email' => $user->email,
        'name' => $user->name,
      ],
    ];
  }
}
