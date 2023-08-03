<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        User::factory([
            'name'  => 'Test Seed account',
            'email' => 'test@example.com',
        ])->create();
    }
}
