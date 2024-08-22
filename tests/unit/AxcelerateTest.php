<?php

namespace Tests\Unit;

use FlipNinja\Axcelerate\Axcelerate;
use FlipNinja\Axcelerate\Contacts\Contact;
use FlipNinja\Axcelerate\Contacts\ContactManager;
use FlipNinja\Axcelerate\Courses\CourseManager;
use FlipNinja\Axcelerate\Courses\Instance;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class AxcelerateTest extends TestCase
{
    private $axcelerate;

    protected function setUp()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
        $dotenv->load();

        $this->axcelerate = new Axcelerate($_ENV['AXCELERATE_APITOKEN'], $_ENV['AXCELERATE_WSTOKEN'], $_ENV['AXCELERATE_URL']);
    }

    public function testContactsReturnsContactManager()
    {
        $this->assertInstanceOf(
            ContactManager::class,
            $this->axcelerate->contacts()
        );
    }

    public function testCoursesReturnCourseManager()
    {
        $this->assertInstanceOf(
            CourseManager::class,
            $this->axcelerate->courses()
        );
    }

    public function testSingletonsAreReturned()
    {
        $this->assertEquals(
            spl_object_hash($this->axcelerate->contacts()),
            spl_object_hash($this->axcelerate->contacts())
        );

        $this->assertEquals(
            spl_object_hash($this->axcelerate->courses()),
            spl_object_hash($this->axcelerate->courses())
        );
    }

    public function testInstanceSearch()
    {

        $instance = $this->axcelerate->courses()->findInstance([
            'InstanceID' => 1975636
        ]);

        $this->assertInstanceOf(
            Instance::class,
            $instance
        );

        print_r($instance);

    }

    public function testInstanceCreate()
    {

        $instance = $this->axcelerate->courses()->createInstance([
            'trainerContactID' => 14192049,
            'name' => 'API test Created UnitTest',
            'startDate' => '2024/08/10',
            'finishDate' => '2024/08/11',
            'startTime' => '9:00:00',
            'finishTime' => '10:00:00',
            'type' => 'w',
            'ID' => 110190
        ]);

        $this->assertTrue(is_int($instance), 'Instance creation should return an integer.');
    }

    public function testInstanceUpdate()
    {

        $instanceUpdated = $this->axcelerate->courses()->updateInstance([
            'ProgramName' => 'Instance Updated using UnitTest',
            'type' => 'w',
            'ID' => 1975636
        ]);

        $this->assertTrue($instanceUpdated);
    }

    public function testContactSearch()
    {
        $contact = $this->axcelerate->contacts()->findByEmail('devcontact@antero.com.au');

        $this->assertInstanceOf(
            Contact::class,
            $contact
        );

//        $enrolments = $contact->enrolments();
//        foreach ($enrolments as $enrolment) {

//            print_r($enrolment);die;
//            $certificate = $contact->certificate($enrolment['ENROLID']);
//            print_r($certificate);
//        }

    }

    public function testEnrollment()
    {
        $invoice = $this->axcelerate->courses()->enrollment([
            'contactID' => 14192049,
            'type' => 'w',
            'instanceID' => 1975636
        ]);

        $this->assertTrue(is_int($invoice), 'Enrollment should return an integer.');
    }
}
