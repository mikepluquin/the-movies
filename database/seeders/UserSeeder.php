<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::create([
            'name' => 'Neo',
            'email' => 'thomas.anderson@themovies.com',
            'password' => Hash::make('M4trix!!'),
        ]);
    }
}
