<?php

namespace App\Tests\Entity;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\UserAuthTest;

class MessageTest extends UserAuthTest
{
    public function testGetAllMessage(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/messages'
        );
        $this->assertResponseIsSuccessful();
    }

    public function testGetMessage(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/messages/1'
        );
        $this->assertResponseIsSuccessful();
    }

    public function testCreateMessage(): void
    {
        $this->testAuthUser()->request(
            'POST',
            '/api/messages',
            [
                'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json',],
                'json'    => [
                    "content" => "hello i send to you this message for your nice house",
                    "sender" => [
                        "id" => 1
                    ],
                    "receiver" => [
                        "id" => 2
                    ]
                ]
            ]
        );
        $this->assertResponseStatusCodeSame(201);
    }

    // public function testUpdateMessage(): void
    // {
    //     $this->testAuthUser()->request(
    //         'PATCH',
    //         '/api/messages/1',
    //         [
    //             'headers' => ['Content-Type' => 'application/merge-patch+json'],
    //             'json' => ['content' => 'this a test content']
    //         ]
    //     );
    //     $this->assertResponseStatusCodeSame(200);
    // }

    // public function testDeleteMessage(): void
    // {
    //     $this->testAuthUser()->request(
    //         'DELETE',
    //         '/api/messages/5',
    //     );
    //     $this->assertResponseStatusCodeSame(204);
    // }
}
