<?php
namespace Computus\Calendar;
use Computus\Calendar;

class Query
{
    protected $calendar;

    /**
     * @var \DateTime
     */
    protected $start;
    /**
     * @var \DateTime
     */
    protected $end;

    public function __construct(Calendar $calendar) {
        $this->calendar = $calendar;
    }

    public function reset()
    {
        $this->start = null;
        $this->end = null;
    }

    public function available(\DateInterval $duration, $num = 1)
    {
        $results = new Calendar();

        $end = clone $this->start;
        $proposedEvent = new ProposedEvent($this->start, $end->add($duration));

        foreach ($this->calendar as $event) {
            if (!$proposedEvent->overlaps($event)) {
                $results->insert($proposedEvent);
            }

            if (count($results) === $num) {
                break;
            }

            $proposedEvent->getStart()->add($duration);
            $proposedEvent->getEnd()->add($duration);

            if ($proposedEvent->getEnd() > $this->end) {
                break;
            }
        }

        return $results;
    }

    public function events($criteria = null)
    {
        $results = new Calendar();

        foreach ($this->calendar as $event) {
            if (($this->start && $event->getStart() < $this->start) ||
                ($this->end && ($this->end < $event->getStart()))) {
                continue;
            }

            $results->insert($event);
        }

        return $results;

    }

    public function between(\DateTime $start, \DateTime $end)
    {
        $this->start = $start;
        $this->end = $end;

        return $this;
    }

    public function after(\DateTime $dateTime)
    {
        $this->start = $dateTime;

        return $this;
    }

    public function before(\DateTime $dateTime)
    {
        $this->end = $dateTime;

        return $this;
    }

    public function excluding($criteria)
    {
        return $this;
    }

    public function at($date)
    {
        return $this;
    }
}