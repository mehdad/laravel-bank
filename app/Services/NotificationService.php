<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function sendTransactionNotification($transaction)
    {
        $sourceAccount = $transaction->sourceAccount;
        $destinationAccount = $transaction->destinationAccount;

        $sourceUser = $sourceAccount->user;
        $destinationUser = $destinationAccount->user;

        $this->sendSms($sourceUser->phone_number, "You have sent {$transaction->amount} to {$destinationUser->name}.");

        $this->sendSms($destinationUser->phone_number, "You have received {$transaction->amount} from {$sourceUser->name}.");
    }

    private function sendSms($phoneNumber, $message)
    {
        Log::info("Sending SMS to {$phoneNumber}: {$message}");
    }
}

