<?php

namespace App\Application\UseCases;

use DB;
use App\Domains\Subscription\Services\SubscriptionService;
use App\Domains\Subscription\Repositories\SubscriptionRepositoryInterface;

/**📘 UseCase (Application Layer)
 * Đặc điểm:

✅ Orchestration - Điều phối nhiều service/repository
✅ Transaction - Quản lý DB transaction
✅ Business Flow - Mô tả cả flow nghiệp vụ
✅ 1 UseCase = 1 User Action ("Người dùng tạo subscription")
 */
class CreateSubscriptionUseCase
{
  public function __construct(
    private SubscriptionRepositoryInterface $repo,
    private SubscriptionService $service
  ) {}

  public function execute(int $userId, string $plan)
  {
    return DB::transaction(function () use ($userId, $plan) {
      // 1. Kiểm tra điều kiện (business rule)
      if ($this->repo->lockByUserId($userId)) {
        throw new \DomainException('Subscription already exists');
      }

      // 2. Gọi Service để tính toán trial
      $trial = $this->service->activateTrial();

      // 3. Lưu vào database
      return $this->repo->create([
        'user_id' => $userId,
        'plan' => $plan,
        ...$trial,
      ]);
    });
  }
}
