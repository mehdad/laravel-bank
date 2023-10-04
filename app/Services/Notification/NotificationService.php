<?php

namespace App\Services\Notification;

use App\Jobs\SendSms;
use Illuminate\Support\Facades\Queue;

class NotificationService
{
    public function sendTransactionNotification($transaction)
    {
        $sourceAccount = $transaction->sourceAccount;
        $destinationAccount = $transaction->destinationAccount;

        $sourceUser = $sourceAccount->user;
        $destinationUser = $destinationAccount->user;

        $message = "You have sent {$transaction->amount} to {$destinationUser->name}.";
        SendSms::dispatch($sourceUser->phone_number, $message);

        $message = "You have received {$transaction->amount} from {$sourceUser->name}.";
        SendSms::dispatch($sourceUser->phone_number, $message);
    }
}

