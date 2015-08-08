<?php

namespace Computus\Test;

use Computus\Calendar;
use Computus\Calendar\Event;

class QueryTest extends \PHPUnit_Framework_TestCase
{
    protected $calendar;

    public function setUp()
    {
        $this->calendar = new Calendar();

        for ($i=0;$i<10;$i++) {
            $this->calendar->insert(Event::create('+' . $i . ' days', '+' . ($i+1) . ' days'));
        }
    }

    public function testFindEvents()
    {
        $results = $this->calendar->find()->events();

        $this->assertEquals(10, count($results));
    }

    public function testFindEventsBetween()
    {
        $results = $this->calendar->find()
                                   ->between(new \DateTime('today'), new \DateTime('tomorrow'))
                                   ->events();

        $this->assertEquals(1, count($results));
    }

    public function testAvailabilityBetweenDates()
    {
        //$calendar->find();
    }
}