<?php

namespace FlipNinja\Axcelerate\Contacts;

use FlipNinja\Axcelerate\ManagerContract;
use FlipNinja\Axcelerate\Resource;
use FlipNinja\Axcelerate\Courses\Instance;

class Enrolment extends Resource
{
    const COMPLETE = 20;
    const INCOMPLETE = 30;
    const CANCELLED = 40;
    const CREDIT_TRANSFER = 60;

    /** @var Contact $contact */
    protected $contact;

    /** @var Instance $instance */
    protected $instance;

    public function __construct(ManagerContract $manager, Contact $contact, Instance $instance)
    {
        $this->contact = $contact;
        $this->instance = $instance;

        parent::__construct([], $manager); // This ins't an actual resource and doesn't have it's own attributes
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

        return (bool) $this->manager->getConnection()->update('course/enrolment', array_merge($attributes, $params));
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
            'programInstanceID' => $this->instance->id,
            'subjectCode' => $competencyCode,
            'competent' => $status,
            'type' => 's'
        ];

        return (bool) $this->manager->getConnection()->update('course/enrolment', $params);
    }
}
