<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'phone_number'];

    public function accounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    public function transactions()
    {
        return $this->hasManyThrough(
            Transaction::class,
            BankAccount::class,
            'user_id',
            'source_account_id'
        );
    }
}
