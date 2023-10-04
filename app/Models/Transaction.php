<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['source_account_id', 'destination_account_id', 'amount'];
    protected $hidden = [
        'laravel_through_key'
    ];

    public function sourceAccount()
    {
        return $this->belongsTo(BankAccount::class, 'source_account_id');
    }

    public function destinationAccount()
    {
        return $this->belongsTo(BankAccount::class, 'destination_account_id');
    }

    public function transactionFee()
    {
        return $this->hasOne(TransactionFee::class);
    }
}

