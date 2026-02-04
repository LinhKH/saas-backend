<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\LoginUserUseCase;

class LoginController extends Controller
{
  public function __invoke(Request $request, LoginUserUseCase $useCase)
  {
    $result = $useCase->execute(
      $request->email,
      $request->password
    );

    return response()->json($result);
  }
}
