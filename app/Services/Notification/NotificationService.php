<?php

namespace App\Services\Notification;

use App\Jobs\SendSms;

class NotificationService
{
    public function sendTransactionNotification($transaction): void
    {
        $sourceAccount = $transaction->sourceAccount;
        $destinationAccount = $transaction->destinationAccount;

        $sourceUser = $sourceAccount->user;
        $destinationUser = $destinationAccount->user;

        $message = __('sms.source.user.message',
            ['amount' => $transaction->amount, 'source_user_name' => $destinationUser->name]
        );
        SendSms::dispatch($sourceUser->phone_number, $message);

        $message = __('sms.destination.user.message',
            ['amount' => $transaction->amount, 'destination_user_name' => $destinationUser->name]
        );
        SendSms::dispatch($sourceUser->phone_number, $message);
    }
}

