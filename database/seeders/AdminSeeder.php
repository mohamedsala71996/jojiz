<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate([
            'name' => 'superadmin',
            'display_name' => 'Super Admin',
            'email' => 'superadmin@arcadexit.com',
            'phone'=>'01531180095',
            'password' => Hash::make('arcadexit'),
            'role_id' => 1,
            'unique_id'=>Str::uuid()
        ]);
    }
}
