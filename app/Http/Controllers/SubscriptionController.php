<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\CreateSubscriptionUseCase;
use App\Application\UseCases\RenewSubscriptionUseCase;

class SubscriptionController extends Controller
{
  public function create(Request $request, CreateSubscriptionUseCase $useCase)
  {
    $sub = $useCase->execute(
      $request->user()->id,
      $request->input('plan', 'free')
    );

    return response()->json($sub);
  }

  public function renew(Request $request, RenewSubscriptionUseCase $useCase)
  {
    $sub = $useCase->execute($request->user()->id);
    return response()->json($sub);
  }
}
