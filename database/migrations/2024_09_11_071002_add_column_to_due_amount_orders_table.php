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
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('due_amount',10,2)->default(0.0)->after('paidAmount');
            $table->decimal('advance_payment_amount',10,2)->default(0.0)->after('due_amount');
            $table->boolean('advance_payment_status')->default(0)->after('advance_payment_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('due_amount');
        });
    }
};
