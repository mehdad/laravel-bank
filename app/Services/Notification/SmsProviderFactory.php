<?php

namespace App\Services\Notification;

use App\Services\Notification\Providers\GhasedakProvider;
use App\Services\Notification\Providers\KavenegarProvider;
use InvalidArgumentException;

class SmsProviderFactory
{
    public static function create($type = null)
    {
        $type = $type ?? config('sms.default');
        if ($type === 'kavenegar') {
            return new KavenegarProvider();
        }
        if ($type === 'ghasedak') {
            return new GhasedakProvider();
        }
        throw new InvalidArgumentException("Invalid SMS provider type");
    }
}
