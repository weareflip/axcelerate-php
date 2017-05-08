<?php

namespace FlipNinja\Axcelerate\Contacts;

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

    /**
     * Find a Contact by Axcelerate ID or return new instance
     *
     * @param int $id
     * @return Contact
     */
    public function firstOrNew($id)
    {
        $response = $this->getConnection()->get('contact/' . $id, []);

        if (! $response) {
            return new Contact([], $this);
        }

        return $response;
    }

    public function search($attributes)
    {
        $response = $this->getConnection()->get('contacts/search', $attributes);

        return $response ? $response : [];
    }

    public function create($attributes)
    {
        $response = $this->getConnection()->create('contact', $attributes);

        return $response ? intval($response['contactid']) : null;
    }
}
