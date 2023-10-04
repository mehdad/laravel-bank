<?php

namespace App\Services\Notification\Providers;

use App\Events\SendSms;
use App\Interfaces\SmsProvider;
use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Support\Facades\Log;

class GhasedakProvider implements SmsProvider
{

    public function sendSms($number, $message): bool
    {
        Log::info("Sending SMS to {$number}: {$message} from Ghasedak");
        try {
            $sender = config('sms.configs.ghasedak.sender');
            GhasedakFacade::SendSimple($number,$message,$sender);
            return true;
        } catch (\Exception $exception) {
            Log::error($exception);
        }
        return false;
    }
}
