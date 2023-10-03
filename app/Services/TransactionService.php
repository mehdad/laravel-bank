<?php
namespace App\Services;

use App\Models\Card;
use App\Models\Transaction;
use App\Models\TransactionFee;
use Exception;

class TransactionService
{
    public function moveBalance($sourceCardNumber, $destinationCardNumber, $amount)
    {
        $sourceAccount = Card::where('card_number', $sourceCardNumber)->first()->bankAccount;
        $destinationAccount = Card::where('card_number', $destinationCardNumber)->first()->bankAccount;

        if ($sourceAccount->balance < $amount) {
            throw new Exception('Insufficient balance');
        }

        $sourceAccount->balance -= $amount;
        $destinationAccount->balance += $amount;

        $sourceAccount->save();
        $destinationAccount->save();

        $transaction = Transaction::create([
            'source_account_id' => $sourceAccount->id,
            'destination_account_id' => $destinationAccount->id,
            'amount' => $amount
        ]);

        TransactionFee::create([
            'transaction_id' => $transaction->id,
            'fee' => 500
        ]);

        return $transaction;
    }
}
