<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('payments', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->string('provider'); // stripe, gmo, mock
      $table->string('provider_payment_id')->nullable();
      $table->string('status');
      $table->integer('amount');
      $table->string('currency', 10)->default('USD');
      $table->string('idempotency_key')->unique();
      $table->timestamps();
      $table->index(columns: ['user_id', 'status']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('payments');
  }
};
