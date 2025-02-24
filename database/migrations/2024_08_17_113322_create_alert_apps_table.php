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
        Schema::create('alert_apps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('discount')->nullable();
            $table->string('type')->nullable();
            $table->string('image')->nullable();
            $table->string('expire_time')->nullable();
            $table->string('link')->nullable();
            $table->string('active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alert_apps');
    }
};
