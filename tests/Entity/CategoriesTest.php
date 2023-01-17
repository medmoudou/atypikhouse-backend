<?php

namespace App\Tests\Entity;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\UserAuthTest;

class CategoriesTest extends UserAuthTest
{
    public function testGetAllCategories(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/categories'
        );
        $this->assertResponseIsSuccessful();
    }

    public function testGetCategorie(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/categories/1'
        );
        $this->assertResponseIsSuccessful();
    }

    public function testCreateCategorie(): void
    {
        $this->testAuthUser()->request(
            'POST',
            '/api/categories',
            [
                'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json',],
                'json'    => [
                    "name" => "bord de mer",
                    "status" => true
                ]
            ]
        );
        $this->assertResponseStatusCodeSame(201);
    }

    public function testUpdateCategorie(): void
    {
        $this->testAuthUser()->request(
            'PATCH',
            '/api/categories/1',
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => ['name' => 'cabane']
            ]
        );
        $this->assertResponseStatusCodeSame(200);
    }

    // public function testDeleteCategorie(): void
    // {
    //     $this->testAuthUser()->request(
    //         'DELETE',
    //         '/api/categories/16',
    //     );
    //     $this->assertResponseStatusCodeSame(204);
    // }
}
