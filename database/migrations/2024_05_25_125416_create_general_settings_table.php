<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_title')->nullable();
            $table->string('web_version')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('facebook_pixel')->nullable();
            $table->text('google_analytics')->nullable();
            $table->text('chat_box')->nullable();
            $table->string('delivary_charge')->nullable();
            $table->float('vat', 10, 2)->default(0);
            $table->string('vat_status')->default('OFF');
            $table->float('tax', 10, 2)->default(0);
            $table->string('tax_status')->default('OFF');
            $table->string('cash_on_delivery')->default('ON');
            $table->string('online_payment')->default('ON');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google')->nullable();
            $table->string('rss')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_image')->nullable();
            $table->string('app_store')->nullable();
            $table->string('apple_store')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
