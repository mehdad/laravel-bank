<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Card::create([
            'bank_account_id' => 1,
            'card_number' => '1234567890123456',
        ]);

        Card::create([
            'bank_account_id' => 1,
            'card_number' => '2345678901234567',
        ]);

        Card::create([
            'bank_account_id' => 3,
            'card_number' => '3456789012345678',
        ]);
    }
}
