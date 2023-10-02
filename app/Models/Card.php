<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['bank_account_id', 'card_number'];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }
}
