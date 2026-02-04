<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
  use RefreshDatabase;

  public function test_user_can_register_and_login()
  {
    $this->postJson('/api/register', [
      'name' => 'Test',
      'email' => 'test@test.com',
      'password' => '123456',
    ])->assertStatus(200);

    $this->postJson('/api/login', [
      'email' => 'test@test.com',
      'password' => '123456',
    ])->assertStatus(200)
      ->assertJsonStructure(['token']);
  }
}
