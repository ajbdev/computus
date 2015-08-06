<?php

namespace Computus\Calendar;

interface EventInterface
{
    public function __construct(\DateTime $start, \DateTime $end);

    public function getStart();

    public function getEnd();
}