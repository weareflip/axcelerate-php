<?php

namespace FlipNinja\Axcelerate\Contacts;

use FlipNinja\Axcelerate\Resource;
use FlipNinja\Axcelerate\Courses\Instance;

class Contact extends Resource
{
    public $idAttribute = 'contactid';

    /**
     * Update Contact's details
     *
     * @param array $attributes Attributes to update
     * @return bool
     */
    public function update($attributes)
    {
        $response = $this->manager->getConnection()->update('contact/' . $this->id, $attributes);

        if ($response) {
            $this->attributes = $response;
            return true;
        }

        return false;
    }

    /**
     * Returns an Enrolment that can be used to update enrolment or it's subjects
     *
     * @param Instance $instance The instance the enrolment is for
     * @return Enrolment
     */
    public function enrolmentForInstance(Instance $instance)
    {
        return new Enrolment($this->manager, $this, $instance);
    }

    /**
     * Returns all enrolments for user
     *
     * @return array<Enrolment>
     */
    public function enrolments()
    {
        return [];
    }
}
