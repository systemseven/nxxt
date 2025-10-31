<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('activitylog:clean')->dailyAt('02:00');
