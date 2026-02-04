<?php

namespace App\Domains\User\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DomainException;

//📌 Tạm dùng Eloquent ở Service này để tập trung vào Auth — Phase sau sẽ clean tiếp

/**
 * 📌 Senior point

Không để controller xử lý bảo mật

Logic lock nằm domain service
 */
class AuthService
{
  private const MAX_ATTEMPTS = 5;
  private const LOCK_MINUTES = 15;

  public function authenticate(string $email, string $password): User
  {
    $user = User::where('email', $email)->first();

    if (!$user) {
      throw new DomainException('Invalid credentials');
    }

    if ($user->locked_until && now()->lessThan($user->locked_until)) {
      $remainingMinutes = now()->diffInMinutes($user->locked_until);
      $remainingSeconds = now()->diffInSeconds($user->locked_until) % 60;

      if ($remainingMinutes > 1) {
        $message = "Account locked. Try again in {$remainingMinutes} minutes and {$remainingSeconds} seconds.";
      } else {
        $message = "Account locked. Try again in {$remainingSeconds} seconds.";
      }

      throw new DomainException($message);
    }

    if (!Hash::check($password, $user->password)) {
      $user->increment('login_attempts');
      $user->refresh();

      if ($user->login_attempts >= self::MAX_ATTEMPTS) {
        $user->update([
          'locked_until' => now()->addMinutes(self::LOCK_MINUTES),
          'login_attempts' => 0,
        ]);
        throw new DomainException('Account locked. Try later.');
      }

      throw new DomainException('Invalid credentials');
    }

    if (!$user->is_active) {
      throw new DomainException('Account is inactive');
    }

    // ✅ LOGIN THÀNH CÔNG → RESET TOÀN BỘ
    $user->update([
      'login_attempts' => 0,
      'locked_until' => null,
    ]);

    return $user;
  }
}
