<?php

namespace App\Tests\Entity;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\UserAuthTest;

class ReservationsTest extends UserAuthTest
{
    public function testGetAllReservations(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/reservations'
        );
        $this->assertResponseIsSuccessful();
    }

    public function testGetReservation(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/reservations/1'
        );
        $this->assertResponseIsSuccessful();
    }

    // public function testCreateReservation(): void
    // {
    //     $this->testAuthUser()->request(
    //         'POST',
    //         '/api/reviews',
    //         [
    //             'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json',],
    //             'json'    => [
    //                 "grade" => 4,
    //                 "comment" => "i like this cabane",
    //                 "user" => [
    //                     "id" => 1
    //                 ],
    //                 "house" => [
    //                     "id" => 1
    //                 ]
    //             ]
    //         ]
    //     );
    //     $this->assertResponseStatusCodeSame(201);
    // }

    public function testUpdateReservation(): void
    {
        $this->testAuthUser()->request(
            'PATCH',
            '/api/reservations/1',
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => ['amount' => 399]
            ]
        );
        $this->assertResponseStatusCodeSame(200);
    }
}
