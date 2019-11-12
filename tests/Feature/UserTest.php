<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testLogin()
    {
        $uri = '/api/user/login';
        $data = [
            'name'     => 'qwe',
            'identity' => 'qwe@q.com',
            'is_email' => true,
            'password' => 'qqqqqq'
        ];
        $headers = [
            'Content-Type' => 'application/json'
        ];
        $response = $this->postJson($uri, $data, $headers);

        $response->assertStatus(200);
    }
}
