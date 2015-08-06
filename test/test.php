<?php
require __DIR__ . '/../vendor/autoload.php';

use Computus\Calendar;

$calendar1 = new Calendar();

$calendar2 = new Calendar();

$dt1 = new \DateTime();
$dt1->modify('+1 day');

$dt2 = new \DateTime();

$calendar1->find()
          ->available('1 hour')
          ->between($dt1, $dt2)
          ->excluding('non-business hours')
;