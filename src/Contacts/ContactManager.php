<?php

namespace FlipNinja\Axcelerate\Contacts;

use FlipNinja\Axcelerate\Exceptions\AxcelerateException;
use FlipNinja\Axcelerate\Manager;
use FlipNinja\Axcelerate\ManagerContract;
use FlipNinja\Axcelerate\Contacts\Contact;

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
        $response = $this->getConnection()->get('contact/' . $id, []);

        return $response ? new Contact($response, $this) : null;
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

        $response = $this->getConnection()->create('contact', $attributes);

        return $response ? intval($response['contactid']) : null;
    }
}
