<?php

namespace App\Domains\User\Repositories;

use App\Domains\User\Entities\UserEntity;

// app/Domains/User/Repositories/UserRepositoryInterface.php
interface UserRepositoryInterface
{
  public function findByEmail(string $email): ?UserEntity;
  public function create(array $data): UserEntity;
}
/**📌 Rule vàng

Domain không biết Laravel hay Eloquent tồn tại */
