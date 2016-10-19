<?php

use Flip\Axcelerate\AxcelerateManager;
use Flip\Axcelerate\Contacts\ContactManager;
use PHPUnit\Framework\TestCase;

class AxcelerateManagerTest extends TestCase
{
    public function testContactsReturnsContactManager()
    {
        $manager = new AxcelerateManager('', '', '');

        $this->assertInstanceOf(
            ContactManager::class,
            $manager->contacts()
        );
    }
}
