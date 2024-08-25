<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilsController extends Controller
{
    public static function intToDuration($integer)
    {
        $minutes = floor(($integer % 3600) / 60);
        $remainingSeconds = $integer % 60;

        $duration = [];

        if ($minutes > 0) {
            $duration[] = ($minutes < 10 ? '0' : '') . $minutes;
        }
        if ($remainingSeconds > 0 || empty($duration)) {
            $duration[] = ($remainingSeconds < 10 ? '0' : '') . $remainingSeconds;
        } else {
            $duration[] = '00';
        }

        return implode(':', $duration);
    }
}
