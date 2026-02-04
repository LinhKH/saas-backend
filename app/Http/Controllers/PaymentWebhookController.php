<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\HandlePaymentWebhookUseCase;

class PaymentWebhookController extends Controller
{
  public function __invoke(Request $request, HandlePaymentWebhookUseCase $useCase)
  {
    try {
      $useCase->execute($request->all());
      return response()->json(['status' => 'ok'], 200);
    } catch (\Throwable $e) {
      // trả 500 để gateway retry
      return response()->json(['error' => 'retry'], 500);
    }
  }
}
