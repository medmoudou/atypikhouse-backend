<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Symfony\Bundle\Test\Client;

class UserAuthTest extends ApiTestCase
{

    public function testAuthUser(): Client
    {
        $client = self::createClient();
        $response = $client->request('POST', '/api/login', [
            'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json'],
            'json' => [
                'username' => 'test10@email.com',
                'password' => 'atypikhouse',
            ],
        ]);
        $json = $response->toArray();
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('token', $json);
        $jwtToken = $json['token'];
        $client = static::createClient([], ['headers' => ['Authorization' => 'bearer ' . $jwtToken]]);
        return $client;
    }

    public function testInvalidLogin(): void
    {
        $response = static::createClient()->request('POST', '/api/login', [
            'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json'],
            'json' => [
                'username' => 'hfjjfbh@nfjd.com',
                'password' => 'azerty!??',
            ]
        ]);
        $this->assertResponseStatusCodeSame(401);
    }
}
