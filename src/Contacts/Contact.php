<?php

namespace Flip\Axcelerate\Contacts;

use Flip\Axcelerate\AxcelerateResource;
use Flip\Axcelerate\Courses\Instance;

class Contact extends AxcelerateResource
{
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
    public function enrolment(Instance $instance)
    {
        return new Enrolment($this->manager, [], $this, $instance);
    }
}
