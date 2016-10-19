# weareflip/axcelerate-php

A PHP package to connect and use the aXcelerate API.


Example usage:

`$contact = $axcelerate->contacts()->find($user->id);`

`$class = $axcelerate->courses()->searchAndGetInstance("%$className%", $teacher->id);`

`$contact->enrolmentForInstance($instance)->updateComptentecyStatus($competencyCode, Enrolment::COMPLETE);`
