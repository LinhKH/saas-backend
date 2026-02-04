<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\CreatePaymentIntentUseCase;

class PaymentController extends Controller
{
  public function create(Request $request, CreatePaymentIntentUseCase $useCase)
  {
    return response()->json(
      $useCase->execute(
        $request->user()->id,
        $request->amount,
        $request->input('currency', 'USD')
      )
    );
  }
}
