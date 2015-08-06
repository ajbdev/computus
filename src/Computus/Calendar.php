<?php

namespace Computus;

use Computus\Calendar\Event;

class Calendar
{
    protected $name;
    protected $events = array();

    public function __construct($name = null) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param Event $event
     */
    public function add(Event $event)
    {
        $this->events[] = $event;
    }

    public function overlaps(Event $event)
    {

    }
}