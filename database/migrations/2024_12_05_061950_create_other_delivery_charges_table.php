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
        Schema::create('other_delivery_charges', function (Blueprint $table) {
            $table->id();
            $table->decimal('normal_delivery_fee')->default(0.00);
            $table->string('normal_delivery_duration')->nullable();
            $table->string('normal_delivery_status')->default(1);
            $table->decimal('express_delivery_fee')->default(0.00);
            $table->string('express_delivery_duration')->nullable();
            $table->string('express_delivery_status')->default(1);
            $table->decimal('pick_up_our_place_fee')->default(0.00);
            $table->string('pick_up_our_place_duration')->nullable();
            $table->string('pick_up_our_place_status')->default(1);
            $table->decimal('free_shipping_fee')->default(0.00);
            $table->string('free_shipping_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_delivery_charges');
    }
};
