<?php

namespace App\Providers;

use App\Domains\Payment\Repositories\PaymentRepositoryInterface;
use App\Domains\Subscription\Repositories\SubscriptionRepositoryInterface;
use App\Infrastructure\Persistence\Repositories\PaymentRepository;
use App\Infrastructure\Persistence\Repositories\SubscriptionRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $bindings = [
      \App\Domains\User\Repositories\UserRepositoryInterface::class => \App\Infrastructure\Persistence\Repositories\UserRepository::class,
      SubscriptionRepositoryInterface::class => SubscriptionRepository::class,
      PaymentRepositoryInterface::class => PaymentRepository::class
    ];
    foreach ($bindings as $interface => $implementation) {
      $this->app->bind($interface, $implementation);
    }
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    //
  }
}
