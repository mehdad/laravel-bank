<?php

namespace App\Services;

use App\Exceptions\AssertException;
use App\Models\BankAccount;
use App\Models\Card;
use App\Models\Transaction;
use App\Models\TransactionFee;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    const TRANSACTION_FEE = 500;
    const TOP_USERS_COUNT = 3;
    const TRANSACTION_PER_EACH_USER = 10;
    const TIME_LIMIT_IN_MINUTES = 10;

    public function getTopTransactions(): array
    {
        $users = User
            ::withCount(['transactions' => function ($query) {
                $query->whereBetween('transactions.created_at', [
                    now()->subMinutes(self::TIME_LIMIT_IN_MINUTES),
                    now()
                ]);
            }])
            ->with(['transactions' => function ($query) {
                $query
                    ->latest()
                    ->take(self::TRANSACTION_PER_EACH_USER);
            }])
            ->having('transactions_count', '>', 0)
            ->orderByDesc('transactions_count')
            ->limit(self::TOP_USERS_COUNT)
            ->get();

        foreach ($users as $user) {
            $info[] = [
                'id' => $user->id,
                'name' => $user->name,
                'transactions' => $user->transactions
            ];
        }
        return $info;
    }


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
        $sourceCardNumber = TextService::convertDigitsToEnglish($sourceCardNumber);
        $sourceCard = Card::where('card_number', $sourceCardNumber)->first();
        if (is_null($sourceCard)) {
            throw new AssertException("$sourceCardNumber is not registered as a card number in system");
        }
        return $sourceCard->bankAccount;
    }
}
