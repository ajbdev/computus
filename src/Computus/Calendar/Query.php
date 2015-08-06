<?php
namespace Computus\Calendar;
use Computus\Calendar;

class Query
{
    protected $calendar;

    const SELECT_AVAILABLE  = 1;
    const SELECT_BUSY       = 2;

    protected $select;


    public function __construct(Calendar $calendar) {
        $this->calendar = $calendar;
    }

    public function available($time)
    {
        $this->select = SELECT_AVAILABLE;
    }



}