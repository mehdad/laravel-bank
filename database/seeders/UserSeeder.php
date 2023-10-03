<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Sample User 1',
            'phone_number' => '09191467719',
        ]);

        User::create([
            'name' => 'Normal User 2',
            'phone_number' => '09191111111',
        ]);
    }
}

