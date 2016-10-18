<?php

namespace Flip\Axcelerate;

use Flip\Axcelerate\Contacts\ContactManager;

class AxcelerateManager
{
    protected $connection;

    protected $contacts;

    public function __construct($baseUri, $wsToken, $apiToken)
    {
        $this->connection = new HttpConnection($baseUri, $wsToken, $apiToken);
        $this->contacts = new ContactManager($this->connection);
    }

    public function contacts()
    {
        return $this->contacts;
    }
}
