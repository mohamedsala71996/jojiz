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
        Schema::create('supplier_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->integer('purchese_id');
            $table->integer('amount')->nullable();
            $table->string('trx_id')->nullable();
            $table->date('date');
            $table->integer('admin_id');
            $table->integer('payment_type_id')->nullable();
            $table->integer('payment_id')->nullable();
            $table->text('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_payments');
    }
};
