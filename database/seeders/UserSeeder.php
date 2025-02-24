<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $user = [
                'name'=>'Test User',
                'gender'=>'male',
                'birthday'=>'2020-12-19',
                'email'=>'user@arcadexit.com',
                'password'=>Hash::make('arcadexit'),
            ];
            User::insert($user);

    }
}
