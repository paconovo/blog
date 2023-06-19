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
    public function run()
    {
        User::create([
            'full_name' => 'Pepe',
            'email' => 'pepe@pepe.com',
            'password' => Hash::make('123456')
        ])->assignRole('Administrator');

        User::create([
            'full_name' => 'manuel',
            'email' => 'manuel@pepe.com',
            'password' => Hash::make('1234546')
        ])->assignRole('Author');
        User::factory(10)->create();
    }
}
