<?php

use App\Console\Commands\ReplayUpload;
use Illuminate\Support\Facades\Schedule;

Schedule::command(ReplayUpload::class)->everyTenSeconds()->withoutOverlapping();
