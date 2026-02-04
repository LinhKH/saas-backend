<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\DTOs\RegisterUserDTO;
use App\Application\UseCases\RegisterUserUseCase;

/**
 * 📌 Controller chỉ làm 3 việc

Nhận request

Tạo DTO

Gọi UseCase
 */
class RegisterController extends Controller
{
  public function __invoke(Request $request, RegisterUserUseCase $useCase)
  {
    $dto = new RegisterUserDTO(
      $request->name,
      $request->email,
      $request->password
    );

    $user = $useCase->execute($dto);

    return response()->json([
      'id' => $user->id,
      'name' => $user->name,
      'email' => $user->email,
      'is_active' => $user->isActive,
    ]);
  }
}
