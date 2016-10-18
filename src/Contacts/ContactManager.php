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
        return new Contact($this, $this->connection->get('/courses/' . $id));
    }
}
