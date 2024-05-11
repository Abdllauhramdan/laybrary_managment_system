<?php

namespace App\Traits;

trait Loggable
{
    protected static function bootLoggable()
    {
        static::created(function ($model) {
            \Log::info('Created: ' . $model);
        });

        static::updated(function ($model) {
            \Log::info('Updated: ' . $model);
        });

        static::deleted(function ($model) {
            \Log::info('Deleted: ' . $model);
        });
    }
}
