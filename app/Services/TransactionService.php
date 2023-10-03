<?php

namespace App\Services;

use App\Exceptions\AssertException;
use App\Models\BankAccount;
use App\Models\Card;
use App\Models\Transaction;
use App\Models\TransactionFee;
use Exception;

class TransactionService
{
    const TRANSACTION_FEE = 500;

    public function moveBalance($sourceCardNumber, $destinationCardNumber, $amount)
    {
        $sourceAccount = $this->validateCardAndGetAccount($sourceCardNumber);
        $destinationAccount = $this->validateCardAndGetAccount($destinationCardNumber);

        if ($sourceAccount == $destinationAccount) {
            throw new AssertException('Source and destination account are the same');
        }

        if ($sourceAccount->balance < $amount + self::TRANSACTION_FEE) {
            throw new AssertException('Insufficient balance');
        }

        $sourceAccount->balance -= $amount - self::TRANSACTION_FEE;
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
            'fee' => self::TRANSACTION_FEE
        ]);

        return $transaction;
    }

    private function validateCardAndGetAccount(string $sourceCardNumber): BankAccount
    {
        $sourceCard = Card::where('card_number', $sourceCardNumber)->first();
        if (is_null($sourceCard)) {
            throw new AssertException("$sourceCardNumber is not registered as a card number in system");
        }
        return $sourceCard->bankAccount;
    }
}
