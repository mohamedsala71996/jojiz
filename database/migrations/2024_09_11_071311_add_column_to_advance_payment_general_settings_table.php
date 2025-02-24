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
        Schema::table('general_settings', function (Blueprint $table) {
            $table->decimal('advance_payment')->default(0.0);
            $table->string('advance_payment_status')->default("OFF");
            $table->string('advance_payment_title')->nullable();
            $table->string('advance_payment_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn('advance_payment');
            $table->dropColumn('advance_payment_status');
            $table->dropColumn('advance_payment_title');
            $table->dropColumn('advance_payment_type');
        });
    }
};
