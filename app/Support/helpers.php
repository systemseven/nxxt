<?php

use Carbon\Carbon;

if (! function_exists('human_or_datetime')) {
    /**
     * Return a human-readable diff if less than x hours old,
     * otherwise show formatted date and time.
     */
    function human_or_datetime(Carbon $date, string $format = 'M j, Y g:i A', int $limit = 2): string
    {
        if ($date->diffInHours(now()) < $limit) {
            return $date->diffForHumans();
        }

        return $date->format($format);
    }
}
