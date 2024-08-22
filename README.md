# flipninja/axcelerate-php

A PHP package to interact with the aXcelerate API.

http://flip.ninja/
https://www.axcelerate.com.au/

## Usage

```php
<?php

use FlipNinja\Axcelerate\Axcelerate;
use FlipNinja\Axcelerate\Contacts\Enrolment;

$axcelerate = new Axcelerate($apiToken, $wsToken, 'https://stg.axcelerate.com.au/api/');

// Find a contact
$contact = $axcelerate->contacts()->find($user->id);

// Find a class/instance
$instance = $axcelerate->courses()->findInstance([
    "name" => "An instance name",
    "trainerContactID" => $teacher->id
]);

// Update a contact's competency status for a class/instance to complete
$contact->enrolmentForInstance($instance)->updateComptentecyStatus($competencyCode, Enrolment::COMPLETE);
```
