<?php

namespace App\Interfaces;

interface SmsProvider
{
    public function sendSms($number, $message): bool;
}
