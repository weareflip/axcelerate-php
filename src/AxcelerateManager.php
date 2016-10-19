<?php

namespace Flip\Axcelerate;

use Flip\Axcelerate\Contacts\ContactManager;
use Flip\Axcelerate\Courses\CourseManager;

class AxcelerateManager
{
    protected $connection;

    protected $contacts;

    protected $courses;

    public function __construct($baseUri, $apiToken, $wsToken)
    {
        $this->connection = new HttpConnection($baseUri, $apiToken, $wsToken);

        $this->contacts = new ContactManager($this->connection);
        $this->courses = new CourseManager($this->connection);
    }

    public function contacts()
    {
        return $this->contacts;
    }

    public function courses()
    {
        return $this->courses;
    }
}
