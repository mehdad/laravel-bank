<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BankAccount;
use App\Models\Card;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $validCardNumbers = [
        '6362147010005732',
        '6274121940067465',
        '5057851990005131',
        '6273811035053633',
        '6221061208750556',
        '5022297000154406',
        '5859837002376347',
        '5029087000550593',
        '6369497010001519',
        '5029387010011416',
        '5894631523343325',
        '6219861008935396',
        '5892107044075003',
        '6396071100252188',
        '6393461018881314',
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (array_chunk($this->validCardNumbers, 2) as $key => $chunk) {
            $user = User::create([
                'name' => "Sample User $key",
                'phone_number' => "091111111" . sprintf("%02d", $key),
            ]);

            $account = BankAccount::create([
                'user_id' => $user->id,
                'balance' => 100000000.00,
            ]);

            foreach ($chunk as $cardNumber) {
                Card::create([
                    'bank_account_id' => $account->id,
                    'card_number' => $cardNumber,
                ]);
            }
        }
    }
}
