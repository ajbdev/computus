<?php

namespace Computus\Calendar;

interface EventInterface
{
    public function __construct(\DateTime $start, \DateTime $end);

    public function getStart();

    public function getEnd();

    public function getAvailable();

    public function overlaps(\DateTime $dateTime);

    public function contains(\DateTime $start, \DateTime $end);

    public function compare(\DateTime $dateTime);
}