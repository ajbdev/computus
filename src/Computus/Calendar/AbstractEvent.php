<?php

namespace Computus\Calendar;

abstract class AbstractEvent implements EventInterface
{
    protected $start;
    protected $end;
    protected $available;
    protected $meta = array();

    /**
     * @param \DateTime $start
     * @param \DateTime $end
     */
    public function __construct(\DateTime $start = null, \DateTime $end = null) {
        $this->start = $start;
        $this->end = $end;
        $this->available = true;
    }

    /**
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param \DateTime $start
     */
    public function setStart(\DateTime $start)
    {
        $this->start = $start;
    }

    /**
     * @param \DateTime $end
     */
    public function setEnd(\DateTime $end)
    {
        if ($this->start >= $end) {
            throw new \InvalidArgumentException('End time must be after the start time');
        }

        $this->end = $end;
    }

    public function getDuration()
    {
        return $this->end->getTimestamp() - $this->start->getTimestamp();
    }

    /**
     * @return bool
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @param bool $available
     */
    public function setAvailable($available)
    {
        $this->available = $available;
    }

    /**
     * @param \DateTime $dateTime
     * @return bool
     */
    public function overlaps(\DateTime $dateTime)
    {
        return $this->compare($dateTime) === 0;
    }

    /**
     * @param \DateTime $start
     * @param \DateTime $end
     * @return bool
     */
    public function contains(\DateTime $start, \DateTime $end)
    {
        return $this->overlaps($start) && $this->overlaps($end);
    }

    /**
     * @param \DateTime $dateTime
     * @return int
     */
    public function compare(\DateTime $dateTime)
    {
        if ($this->getEnd() < $dateTime) {
            return -1;
        }
        if ($this->getStart() > $dateTime) {
            return 1;
        }
        return 0;
    }

    public function __set($key, $val) {
        $this->meta[$key] = $val;
    }

    public function __get($key) {
        return $this->meta[$key];
    }
}