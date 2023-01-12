<?php

namespace App\Tests\Entity;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\UserAuthTest;

class UsersTest extends UserAuthTest
{
    public function testGetAllUsers(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/users'
        );
        $this->assertResponseIsSuccessful();
    }

    public function testGetUser(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/users/1'
        );
        $this->assertResponseIsSuccessful();
    }

    public function testCreateInvalidUser(): void
    {
        static::createClient()->request('POST', '/api/register', [
            'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json',],
            'json' => [
                'email' => '',
                'firstname' => '',
                'lastname' => '',
                'number' => '',
            ]
        ]);

        $this->assertResponseStatusCodeSame(422);
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

    public function testUpdateUser(): void
    {
        $this->testAuthUser()->request(
            'PATCH',
            '/api/users/35/update',
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => ['firstname' => 'test1']
            ]
        );
        $this->assertResponseStatusCodeSame(200);
    }

    // public function testDeleteUser(): void
    // {
    //     $this->testAuthUser()->request(
    //         'DELETE',
    //         '/api/users/37',
    //         // ['headers' => ['Content-Type' => 'application/merge-patch+json']]
    //     );
    //     $this->assertResponseStatusCodeSame(204);
    // }
}
