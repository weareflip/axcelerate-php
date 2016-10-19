<?php

use Flip\Axcelerate\Axcelerate;
use Flip\Axcelerate\Contacts\ContactManager;
use Flip\Axcelerate\Courses\CourseManager;
use PHPUnit\Framework\TestCase;

class AxcelerateTest extends TestCase
{
    public function testContactsReturnsContactManager()
    {
        $axcelerate = new Axcelerate('', '', '');

        $this->assertInstanceOf(
            ContactManager::class,
            $axcelerate->contacts()
        );
    }

    public function testCoursesReturnCourseManager()
    {
        $axcelerate = new Axcelerate('', '', '');

        $this->assertInstanceOf(
            CourseManager::class,
            $axcelerate->courses()
        );
    }
}
