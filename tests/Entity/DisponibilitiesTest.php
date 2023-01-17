<?php

namespace App\Tests\Entity;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\UserAuthTest;

class DisponibilitiesTest extends UserAuthTest
{
    public function testGetAllDisponibilities(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/disponibilities'
        );
        $this->assertResponseIsSuccessful();
    }

    public function testGetDisponibilitie(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/disponibilities/1'
        );
        $this->assertResponseIsSuccessful();
    }
}
