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
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->string('courierName');
            // $table->string('hasCity')->default('off');
            // $table->string('hasZone')->default('off');
            // $table->string('hasArea')->default('off');
            $table->string('charge');
            $table->string('available')->nullable();
            $table->string('image')->nullable();
            // $table->string('insideDhakaCharge');
            // $table->string('nearestDhakaCharge');
            // $table->string('outsideDhakaCharge');
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couriers');
    }
};
