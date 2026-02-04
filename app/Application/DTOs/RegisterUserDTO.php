<?php

namespace App\Application\DTOs;

class RegisterUserDTO
{
  // Tách biệt rõ ràng giữa HTTP và Business Logic
  public function __construct(
    public string $name,
    public string $email,
    public string $password
  ) {}
}
