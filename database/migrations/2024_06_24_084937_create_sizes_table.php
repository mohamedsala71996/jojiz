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
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->bigInteger('varient_id');
            $table->integer('size_id');
            $table->string('size');
            $table->integer('RegularPrice')->default(0);
            $table->integer('SalePrice')->default(0);
            $table->integer('Discount')->default(0);
            $table->integer('buy_price')->default(0);
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
        Schema::dropIfExists('sizes');
    }
};
