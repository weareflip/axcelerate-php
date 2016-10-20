<?php

namespace Flip\Axcelerate\Contacts;

use Flip\Axcelerate\AxcelerateResource;
use Flip\Axcelerate\Courses\Instance;

class Contact extends AxcelerateResource
{
    /** @var string $idAttribute Automatically assigned ID field */
    public $idAttribute = 'contactid';

    /** @var ContactManager $manager */
    protected $manager;

    /**
     * Update Contact's details
     *
     * @param array $attributes Attributes to update
     * @return mixed
     */
    public function update($attributes)
    {
        return $this->manager->update($this->id, $attributes);
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
