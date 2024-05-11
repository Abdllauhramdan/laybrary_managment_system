<?php

namespace App\Helpers;

class Helper
{
    public static function formatDate($date, $format = 'Y-m-d H:i:s')
    {
        return \Carbon\Carbon::parse($date)->format($format);
    }

    public static function cacheData($key, $data, $duration = 60)
    {
        return \Illuminate\Support\Facades\Cache::remember($key, $duration, function () use ($data) {
            return $data;
        });
    }
}
