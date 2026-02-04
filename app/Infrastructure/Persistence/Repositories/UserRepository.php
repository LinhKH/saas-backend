<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domains\User\Entities\UserEntity;
use App\Domains\User\Repositories\UserRepositoryInterface;
use App\Models\User;

/**
 * 📌 Senior điểm cộng

Mapping Eloquent → Entity

Có thể đổi ORM mà domain không đổi
 */
class UserRepository implements UserRepositoryInterface
{
  public function findByEmail(string $email): ?UserEntity
  {
    $user = User::where('email', $email)->first();

    return $user ? new UserEntity(
      $user->id,
      $user->email,
      $user->name,
      $user->is_active
    ) : null;
  }

  public function create(array $data): UserEntity
  {
    $user = User::create($data);

    return new UserEntity(
      $user->id,
      $user->email,
      $user->name,
      $user->is_active
    );
  }
}
