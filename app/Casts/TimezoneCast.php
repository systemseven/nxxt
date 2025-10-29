<?php

namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class TimezoneCast implements CastsAttributes
{
    public function __construct(protected string $timezone = 'America/New_York') {}

    public function get($model, string $key, $value, array $attributes)
    {
        return $value ? Carbon::parse($value)->timezone($this->timezone) : null;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value ? Carbon::parse($value)->timezone('UTC') : null;
    }
}
