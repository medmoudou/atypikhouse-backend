<?php

namespace App\Tests\Entity;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\UserAuthTest;

class HousesTest extends UserAuthTest
{
    public function testGetAllHouses(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/houses');
        $this->assertResponseIsSuccessful();
    }

    public function testGetHouse(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/houses/1'
        );
        $this->assertResponseIsSuccessful();
    }

    // public function testCreateValidUser(): void
    // {
    //     $response = static::createClient()->request(
    //         'POST',
    //         '/api/register',
    //         [
    //             'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json',],
    //             'json'    => [
    //                 'email' => 'test1122@gmail.com',
    //                 'password' => 'atypikhouse',
    //                 'firstname' => 'hamza',
    //                 'lastname' => 'elyamouni',
    //                 'number' => '0776635627',
    //                 'birthday'    => '1985-07-31',
    //                 'address' => [
    //                     'address' => '1 rue bosio',
    //                     'city' => 'Paris',
    //                     'zipcode' => '75016',
    //                     'country' => 'France',
    //                 ],
    //             ]
    //         ]
    //     );
    //     $this->assertResponseStatusCodeSame(201);
    // }

    public function testUpdateHouse(): void
    {
        $this->testAuthUser()->request(
            'PATCH',
            '/api/houses/1',
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => ['title' => 'house test title']
            ]
        );
        $this->assertResponseStatusCodeSame(200);
    }

    // public function testDeleteUser(): void
    // {
    //     $this->testAuthUser()->request(
    //         'DELETE',
    //         '/api/houses/24',
    //         // ['headers' => ['Content-Type' => 'application/merge-patch+json']]
    //     );
    //     $this->assertResponseStatusCodeSame(204);
    // }
}
