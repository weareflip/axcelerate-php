<?php

use FlipNinja\Axcelerate\Axcelerate;
use FlipNinja\Axcelerate\Contacts\ContactManager;
use FlipNinja\Axcelerate\Courses\CourseManager;
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

    public function testSingletonsAreReturned()
    {
        $axcelerate = new Axcelerate('', '', '');

        $this->assertEquals(
            spl_object_hash($axcelerate->contacts()),
            spl_object_hash($axcelerate->contacts())
        );

        $this->assertEquals(
            spl_object_hash($axcelerate->courses()),
            spl_object_hash($axcelerate->courses())
        );
    }
}
