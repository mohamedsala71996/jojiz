<?php

namespace Database\Seeders;

use App\Models\MailSetting;
use Illuminate\Database\Seeder;

class MailConfigarationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mail_settings = array(
            array('id' => '1', 'MAIL_MAILER' => 'smtp', 'MAIL_HOST' => 'mail.arcadexit.com', 'MAIL_PORT' => '465', 'MAIL_USERNAME' => 'info@arcadexit.com', 'MAIL_PASSWORD' => 'Arcadexit#0205', 'MAIL_ENCRYPTION' => 'tls', 'MAIL_FROM_ADDRESS' => 'info@arcadexit.com', 'MAIL_FROM_NAME' => 'Shopaholic', 'created_at' => '2024-07-11 09:50:38', 'updated_at' => '2024-07-11 09:50:38'),
        );

        MailSetting::insert($mail_settings);

    }
}
