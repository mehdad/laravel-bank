<?php

namespace App\Services\Notification\Providers;

use App\Interfaces\SmsProvider;
use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Support\Facades\Log;

class GhasedakProvider implements SmsProvider
{

    public function sendSms($number, $message)
    {
        Log::info("Sending SMS to {$number}: {$message} from Ghasedak");
        try {
            $sender = config('sms.configs.ghasedak.sender');
            GhasedakFacade::SendSimple($number,$message,$sender);
        } catch (\Exception $exception) {
            Log::log('Add to list again');
            throw $exception;
        }
    }
}
