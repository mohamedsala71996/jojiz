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
        Schema::create('weights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->bigInteger('varient_id');
            $table->integer('weight_id');
            $table->string('weight');
            $table->decimal('RegularPrice', 10, 2)->default(0);
            $table->decimal('SalePrice', 10, 2)->default(0);
            $table->decimal('Discount', 10, 2)->default(0);
            $table->integer('total_stock')->default(0);
            $table->integer('stock')->default(0);
            $table->integer('sold')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weights');
    }
};
