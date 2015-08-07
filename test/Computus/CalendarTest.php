<?php

namespace Computus\Test;

use Computus\Calendar;
use Computus\Calendar\Event;

class CalendarTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Calendar
     */
    protected $calendar;

    public function setUp()
    {
        $this->calendar = new Calendar('Test Case');
    }

    public function testCombine()
    {
        $calendar2 = new Calendar('Test Case 2');
        $event1 = Event::create('5/12/2014','5/13/2014');
        $event2 = Event::create('6/1/2015','6/2/2015');

        $this->calendar->insert($event1);
        $calendar2->insert($event2);

        $combined = $this->calendar->combine($calendar2);
        $this->assertEquals(count($combined), 2);
    }

    public function testSortDateAscending()
    {
        $evt1 = Event::create('5/12/2015','5/13/2015');
        $evt2 = Event::create('7/1/2015','7/1/2015');

        $this->calendar->insert($evt2);
        $this->calendar->insert($evt1);

        $this->assertEquals($evt1,$this->calendar->current());
    }
}