<?php

namespace App\Helpers;

use DateTime;
class Helper
{
function formateDate($dateString, $format = 'Y-m-d')
{
    $date = new DateTime($dateString);
    return $date->format($format);
}
public static function cacheData($key, $data, $duration = 60)
{
    return \Illuminate\Support\Facades\Cache::remember($key, $duration, function () use ($data) {
        return $data;
    });
}
}