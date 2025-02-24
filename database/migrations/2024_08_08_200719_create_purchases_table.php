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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceID');
            $table->date('date');
            $table->bigInteger('supplier_id');
            $table->integer('deliveryCharge')->default(0);
            $table->float('totalAmount', 10, 2)->default(0);
            $table->float('paid', 10, 2)->default(0);
            $table->float('due', 10, 2)->default(0);
            $table->string('status')->default('Active');
            $table->integer('admin_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
