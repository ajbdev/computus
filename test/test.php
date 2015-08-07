<?php
require __DIR__ . '/../vendor/autoload.php';

use Computus\Calendar;
use Computus\Calendar\Event;

$calendar = new Calendar();


$lunch = Event::create('Tomorrow 12:00 PM', 'Tomorrow 1:00 PM');

$calendar->insert($lunch);


$calendar->find()
         ->at('next Tuesday')
         ->available('1 hour')
;

$calendar->find()
         ->between('Monday', 'Friday')
         ->events()
;

// Search for time available between two calendars

$andysCalendar = new Calendar("Andy's Calendar");

$marysCalendar = new Calendar("Mary's Calendar");

$nextAvailableTime = $andysCalendar->combine($marysCalendar)->find()->at('tomorrow')->available('1 hour');

$nextAvailableTime->location = '8th St Grill';
$nextAvailableTime->subject = 'Happy Hour';

// Schedule scrum meeting for every weekday at 2 PM

$scrumCal = new Calendar('Scrum Calendar');

$scrum = Event::create('today');
$scrum->schedule('daily','1:00 PM');

$scrumCal->insert($scrum);

// Are you able to make the 7 AM meeting tomorrow?

$event = Event::create('Tomorrow 7:00 AM', 'Tomorrow 8:00 AM');

if ($andysCalendar->free($event)) {
    $andysCalendar->insert($event);
} else {
    echo 'FUCK NO I AINT GETTIN UP THAT EARLY';
}

// Do you have time after 3 tomorrow to talk?

$event = $andysCalendar->find()->at('tomorrow')->after('3:00 PM')->available('1 hour');

