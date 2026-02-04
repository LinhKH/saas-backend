<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Domains\Payment\Events\PaymentSucceeded;
use App\Application\UseCases\RenewSubscriptionUseCase;

class ActivateSubscriptionAfterPayment implements ShouldQueue
{
  // InteractsWithQueue là một trait trong Laravel cung cấp các phương thức để tương tác với queue job từ bên trong listener hoặc job.
  /**Trait này cung cấp các phương thức:
$this->delete() - Xóa job khỏi queue ngay lập tức
$this->release($delay) - Đưa job trở lại queue để thử lại sau một khoảng thời gian
$this->fail($exception) - Đánh dấu job là failed
$this->attempts() - Lấy số lần job đã được thực thi */
  use InteractsWithQueue;

  public int $tries = 5;
  public int $backoff = 30;

  public function __construct(
    private RenewSubscriptionUseCase $useCase
  ) {}

  public function handle(PaymentSucceeded $event): void
  {
    $this->useCase->execute($event->payment->userId);
  }
}
