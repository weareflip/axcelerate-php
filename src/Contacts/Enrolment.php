<?php

namespace Flip\Axcelerate\Contacts;

use Flip\Axcelerate\AxcelerateResource;
use Flip\Axcelerate\Courses\Instance;
use Flip\Axcelerate\ManagerContract;

class Enrolment extends AxcelerateResource
{
    const COMPLETE = 20;
    const INCOMPLETE = 30;
    const CANCELLED = 40;

    /** @var Contact $contact */
    protected $contact;

    /** @var Instance $instance */
    protected $instance;

    public function __construct(ManagerContract $manager, Contact $contact, Instance $instance)
    {
        $this->contact = $contact;
        $this->instance = $instance;

        parent::__construct([], $manager); // This ins't an actual model and doesn't have any attributes of it's own
    }

    /**
     * Update a contact's course enrolment
     *
     * @param array $attributes
     * @return bool
     */
    public function update($attributes)
    {
        $params = [
            'contactID' => $this->contact->id,
            'instanceID' => $this->instance->id,
            'type' => 'p'
        ];

        $this->manager->getConnection()->update('course/enrolment', array_merge($params, $attributes));

        return true;
    }

    /**
     * Update the static of a unit of competency
     *
     * @param string $competencyCode
     * @param int $status The status code (static::COMPLETE, static::INCOMPLETE, static::CANCELLED are valid options)
     * @return bool
     */
    public function updateCompetencyStatus($competencyCode, $status)
    {
        $params = [
            'contactID' => $this->contact->id,
            'subjectCode' => $competencyCode,
            'status' => $status
        ];

        $this->manager->getConnection()->update('course/enrolment', $params);

        return true;
    }
}
