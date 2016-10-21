<?php

use FlipNinja\Axcelerate\Connection\MockConnection;
use FlipNinja\Axcelerate\Contacts\Contact;
use FlipNinja\Axcelerate\Contacts\ContactManager;
use PHPUnit\Framework\TestCase;

class ContactManagerTest extends TestCase
{
    protected $connection;

    protected $manager;

    public function setUp()
    {
        $this->connection = new MockConnection('', '', '');
        $this->manager = new ContactManager($this->connection);
    }

    public function testFindReturnsTheContact()
    {
        $this->connection->setResponse([
            'contactid' => 1
        ]);

        $contact = $this->manager->find(1);

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertAttributeEquals(1, 'id', $contact);
    }
}
