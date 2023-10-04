<?php

namespace App\Services\Notification;

use App\Services\Notification\Providers\GhasedakProvider;
use App\Services\Notification\Providers\KavehnegarProvider;
use InvalidArgumentException;

class SmsProviderFactory
{
    public static function create($type)
    {
        if ($type === 'kavehnegar') {
            return new KavehnegarProvider();
        }
        if ($type === 'ghasedak') {
            return new GhasedakProvider();
        }
        throw new InvalidArgumentException("Invalid SMS provider type");
    }
}
