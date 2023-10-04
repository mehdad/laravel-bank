<?php

namespace App\Services\Notification\Providers;

use App\Interfaces\SmsProvider;
use App\Jobs\SendSms;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Kavenegar\KavenegarApi;

class KavenegarProvider implements SmsProvider
{
    public function sendSms($number, $message): bool
    {
        Log::info("Sending SMS to {$number}: {$message} from kavenegar");
        try {
            $sender = config('sms.configs.kavenegar.sender');
            $receptor = array($number);
            $api = new KavenegarApi(config('sms.configs.kavenegar.api_key'));
            $api->Send($sender, $receptor, $message);
            return true;
        } catch (\Exception $exception) {
            Log::error($exception);
        }
        return false;
    }
}
