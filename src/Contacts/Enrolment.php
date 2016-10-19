<?php

namespace Flip\Axcelerate\Contacts;

use Flip\Axcelerate\AxcelerateResource;
use Flip\Axcelerate\Courses\Instance;

class Enrolment extends AxcelerateResource
{
    /** @var Contact $contact */
    protected $contact;

    /** @var Instance $instance */
    protected $instance;

    public function __construct($manager, Contact $contact, Instance $instance)
    {
        $this->contact = $contact;
        $this->instance = $instance;

        parent::__construct([], $manager); // This ins't an actual model and doesn't have any attributes of it's own
    }

    public function update($attributes)
    {
        // @TODO Post with $contact->id and $instance->id
    }

    // @TODO Maybe make updateSubject/updateComptency as a separate function for validation purposes
}
