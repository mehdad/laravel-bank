<?php

namespace App\Services\Notification\Providers;

use App\Interfaces\SmsProvider;
use Illuminate\Support\Facades\Log;

class GhasedakProvider implements SmsProvider
{

    public function sendSms($number, $message)
    {
        Log::info("Sending SMS to {$number}: {$message} from Ghasedak");

    }
}
