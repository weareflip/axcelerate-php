<?php

namespace Flip\Axcelerate\Contacts;

class Contact
{
    protected $manager;

    public function __construct(ContactManager $manager)
    {
        $this->manager = $manager;
    }
}
