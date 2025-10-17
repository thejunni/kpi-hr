<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Juni',
            'email' => 'dejuniartaa@gmail.com',
            'password' => Hash::make('juni!@#123'),
        ]);
    }
}
