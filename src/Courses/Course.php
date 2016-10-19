<?php

namespace Flip\Axcelerate\Courses;

use Flip\Axcelerate\AxcelerateResource;

class Course extends AxcelerateResource
{
    // @TODO We'll be used is like $course->searchForInstance(['name' => '%$classname%', 'trainerid' => $contact->id])
    // May be refactored later when we bring in trainers
    public function searchForInstance($attributes)
    {
        //
    }
}
