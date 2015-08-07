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