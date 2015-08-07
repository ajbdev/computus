<?php
/**
 * Created by PhpStorm.
 * User: andybaird
 * Date: 8/6/15
 * Time: 9:17 PM
 */

namespace Computus\Calendar;


class Event
{
    public static function create($start, $end = null)
    {
        return new RepeatableEvent(self::parse($start), self::parse($end));
    }

    public static function parse($dt) {
        if (is_null($dt)) {
            return null;
        }
        if ($dt instanceof \DateTime) {
            return $dt;
        }
        return new \DateTime($dt);
    }
}