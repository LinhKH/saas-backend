<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\LoginUserUseCase;
use App\Application\UseCases\GenerateUserTokenUseCase;

class LoginController extends Controller
{
  public function __invoke(
    Request $request,
    LoginUserUseCase $loginUseCase,
    GenerateUserTokenUseCase $tokenUseCase
  ) {
    //✅ Step 1: Authenticate user (Domain logic)
    $userId = $loginUseCase->execute(
      $request->email,
      $request->password
    );

    //✅ Step 2: Generate token (Infrastructure logic)
    $token = $tokenUseCase->execute($userId);

    return response()->json(['token' => $token]);
  }
}
//✅ Controller chỉ điều phối Use Cases - KHÔNG gọi trực tiếp Model
