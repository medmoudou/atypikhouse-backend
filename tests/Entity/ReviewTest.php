<?php

namespace App\Tests\Entity;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\UserAuthTest;

class ReviewTest extends UserAuthTest
{
    public function testGetAllReviews(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/reviews'
        );
        $this->assertResponseIsSuccessful();
    }

    public function testGetReview(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/reviews/1'
        );
        $this->assertResponseIsSuccessful();
    }

    public function testCreateReview(): void
    {
        $this->testAuthUser()->request(
            'POST',
            '/api/reviews',
            [
                'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json',],
                'json'    => [
                    "grade" => 4,
                    "comment" => "i like this cabane",
                    "user" => [
                        "id" => 1
                    ],
                    "house" => [
                        "id" => 1
                    ]
                ]
            ]
        );
        $this->assertResponseStatusCodeSame(201);
    }

    public function testUpdateReview(): void
    {
        $this->testAuthUser()->request(
            'PATCH',
            '/api/reviews/1',
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => ['comment' => 'this a test comment']
            ]
        );
        $this->assertResponseStatusCodeSame(200);
    }

    // public function testDeleteReview(): void
    // {
    //     $this->testAuthUser()->request(
    //         'DELETE',
    //         '/api/reviews/5',
    //     );
    //     $this->assertResponseStatusCodeSame(204);
    // }
}
