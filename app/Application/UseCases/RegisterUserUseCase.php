<?php

namespace App\Application\UseCases;

use App\Application\DTOs\RegisterUserDTO;
use App\Domains\User\Entities\UserEntity;
use App\Domains\User\Repositories\UserRepositoryInterface;
use DomainException;

/**
 * 📌 Senior tư duy

Use case = 1 hành động nghiệp vụ

Không làm nhiều việc
 */
class RegisterUserUseCase
{
  public function __construct(
    private UserRepositoryInterface $userRepo
  ) {}

  public function execute(RegisterUserDTO $dto): UserEntity
  {
    if ($this->userRepo->findByEmail($dto->email)) {
      throw new DomainException('Email already exists');
    }

    return $this->userRepo->create([
      'email' => $dto->email,
      'name' => $dto->name,
      'password' => bcrypt($dto->password),
      'is_active' => true,
    ]);
  }
}
