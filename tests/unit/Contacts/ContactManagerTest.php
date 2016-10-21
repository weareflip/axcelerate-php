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

    public function testFindReturnsAContact()
    {
        $this->connection->setResponse([
            'contactid' => 1001
        ]);

        $contact = $this->manager->find(1001);

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertAttributeEquals(1001, 'id', $contact);
    }

    public function testCreateReturnsAContactId()
    {
        $contactData = [
            'givenName' => 'John',
            'surname' => 'Doe',
            'emailAddress' => 'john@example.com'
        ];

        $this->connection->setResponse([
            'contactid' => '1001'
        ]);
        $contactId = $this->manager->create($contactData);

        $this->assertEquals(1001, $contactId);
        $this->assertInternalType('int', $contactId);
    }
}
