<?php

namespace FlipNinja\Axcelerate\Contacts;

use FlipNinja\Axcelerate\Exceptions\AxcelerateException;
use FlipNinja\Axcelerate\Manager;
use FlipNinja\Axcelerate\ManagerContract;

class ContactManager extends Manager implements ManagerContract
{
    /**
     * Find a Contact by Axcelerate ID
     *
     * @param int $id
     * @return Contact|null
     */
    public function find($id)
    {
        $contact = $this->getConnection()->get('contact/' . $id, []);

        return $contact ? new Contact($contact, $this) : null;
    }

    /**
     * Find a Contact by emailAddress
     *
     * @param string $email
     * @return Contact|null
     */
    public function findByEmail($email)
    {
        $response = $this->search([
            'emailAddress' => $email
        ]);

        return $response ? new Contact($response[0], $this) : null;
    }

    public function search($attributes)
    {
        $response = $this->getConnection()->get('contacts/search', $attributes);

        return $response ? $response : [];
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

        $contact = $this->getConnection()->create('contact', $attributes);

        return $contact ? $this->find($contact->CONTACTID) : null; // @TODO Didn't we change this to lower case?
    }

    public function update($id, $attributes)
    {
        $contact = $this->getConnection()->update('contact/' . $id, $attributes);

        return $contact ? $this->find($contact->CONTACTID) : null;
    }
}
