<?php

namespace App\Tests\Entity;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\UserAuthTest;

class NotificationsTest extends UserAuthTest
{
    public function testGetAllNotifications(): void
    {
        $this->testAuthUser()->request(
            'GET',
            '/api/notifications'
        );
        $this->assertResponseIsSuccessful();
    }
}
