<?php

namespace FlipNinja\Axcelerate\Contacts;

use FlipNinja\Axcelerate\Manager;
use FlipNinja\Axcelerate\ManagerContract;
use FlipNinja\Axcelerate\Contacts\Contact;

class ContactManager extends Manager implements ManagerContract
{
    public function find($id)
    {
        $response = $this->getConnection()->get('contact/' . $id, []);

        return $response ? new Contact($response, $this) : null;
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

        $response = $this->getConnection()->create('contact', $attributes);

        return $response ? intval($response['contactid']) : null;
    }
}
