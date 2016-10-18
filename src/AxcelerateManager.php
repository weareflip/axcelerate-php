<?php

namespace Flip\Axcelerate;

use Flip\Axcelerate\Contacts\ContactManager;

class AxcelerateManager
{
    protected $contacts;

    public function __construct()
    {
        $this->contacts = new ContactManager();
    }

    public function contacts()
    {
        return $this->contacts;
    }
}
