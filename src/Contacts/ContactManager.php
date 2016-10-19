<?php

namespace Flip\Axcelerate\Contacts;

use Flip\Axcelerate\HttpConnection;

class ContactManager
{
    protected $connection;

    public function __construct(HttpConnection $connection)
    {
        $this->connection = $connection;
    }

    public function find($id)
    {
        $contact = $this->connection->get('contact/' . $id);

        return $contact ? new Contact($this, $contact) : null;
    }

    public function create($attributes)
    {
        $required = [
            'givenName',
            'surname',
            'emailAddress'
        ];

        if ($diff = array_diff($required, array_keys($attributes))) {
            throw new \InvalidArgumentException('Required fields not present: ' . implode(', ', $diff));
        }

        $contact = $this->connection->create('contact', $attributes);

        return $contact ? $this->find($contact->CONTACTID) : null;
    }
}
