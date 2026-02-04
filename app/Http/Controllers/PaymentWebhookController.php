<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\HandlePaymentWebhookUseCase;

class PaymentWebhookController extends Controller
{
  public function __invoke(Request $request, HandlePaymentWebhookUseCase $useCase)
  {
    $useCase->execute($request->all());
    return response()->json(['status' => 'ok']);
  }
}
