<?php

namespace App\Services\Notification\Providers;

use App\Exceptions\AssertException;
use App\Interfaces\SmsProvider;
use Illuminate\Support\Facades\Log;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Kavenegar\KavenegarApi;

class KavenegarProvider implements SmsProvider
{
    public function sendSms($number, $message)
    {
        Log::info("Sending SMS to {$number}: {$message} from kavenegar");
        try {
            $sender = config('sms.configs.kavenegar.sender');
            $receptor = array($number);
            $api = new KavenegarApi(config('sms.configs.kavenegar.api_key'));
            $api->Send($sender, $receptor, $message);
        } catch (\Exception $exception) {
            Log::log('Add to list again');
            throw $exception;
        }
    }
}
