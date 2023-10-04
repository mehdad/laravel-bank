<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'phone_number'];

    public function bank_accounts()
    {
        return $this->hasMany(BankAccount::class);
    }
}
