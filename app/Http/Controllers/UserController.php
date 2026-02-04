<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Application\UseCases\UpdateUserUseCase;

class UserController extends Controller
{
  public function update(
    Request $request,
    User $user,
    UpdateUserUseCase $useCase
  ) {
    $this->authorize('update', $user);

    $updated = $useCase->execute(
      $user,
      $request->only(['name', 'email'])
    );

    return response()->json([
      'id' => $updated->id,
      'name' => $updated->name,
      'email' => $updated->email,
    ]);
  }
}
