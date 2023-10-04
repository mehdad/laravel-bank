<?php

namespace App\Jobs;

use App\Services\Notification\SmsProviderFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Queue;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const RETRY_SEND_IN_SECONDS = 300;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $phoneNumber, private string $message)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $smsProvider = SmsProviderFactory::create();
        if (!$smsProvider->sendSms($this->phoneNumber, $this->message)) {
            Queue::later(self::RETRY_SEND_IN_SECONDS, new SendSms($this->phoneNumber, $this->message));
        }
    }
}
