<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('f_a_q_s')->insert([
            [
                'title' => 'How to register as a seller?',
                'description' => '<p>To register as a seller, follow the steps provided in our registration guide.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'How to reset my password?',
                'description' => '<p>Click on the "Forgot Password" link on the login page to reset your password.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'How can I track my order?',
                'description' => '<p>You can track your order through your account dashboard by clicking on the "Track Order" link.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
