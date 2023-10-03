<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create bank accounts
        BankAccount::create([
            'user_id' => 1, // Replace with the appropriate user ID
            'balance' => 1000.00,
        ]);

        BankAccount::create([
            'user_id' => 2, // Replace with the appropriate user ID
            'balance' => 500.00,
        ]);
    }
}
