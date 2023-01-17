<?php

namespace App\Tests\Entity;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\UserAuthTest;

class EquipementTest extends UserAuthTest
{
    public function testGetAllEquipements(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/equipements'
        );
        $this->assertResponseIsSuccessful();
    }

    // public function testCreateEquipement(): void
    // {
    //     $this->testAuthUser()->request(
    //         'POST',
    //         '/api/equipements',
    //         [
    //             'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json',],
    //             'json'    => [
    //                 "name" => "Wifi",
    //                 "status" => true
    //             ]
    //         ]
    //     );
    //     $this->assertResponseStatusCodeSame(201);
    // }

    // public function testUpdateEquipement(): void
    // {
    //     $this->testAuthUser()->request(
    //         'PATCH',
    //         '/api/equipements/16',
    //         [
    //             'headers' => ['Content-Type' => 'application/merge-patch+json'],
    //             'json' => ['name' => 'bord de mer']
    //         ]
    //     );
    //     $this->assertResponseStatusCodeSame(200);
    // }
}
