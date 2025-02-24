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
        Schema::create('orderproducts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('productSku')->nullable();
            $table->string('productName');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->integer('size_id')->nullable();
            $table->string('code')->nullable();
            $table->integer('code_id')->nullable();
            $table->string('weight')->nullable();
            $table->integer('weight_id')->nullable();
            $table->foreignId('productvariation_id')->nullable()->constrained('productvariations')->nullOnDelete();
            $table->integer('price');
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderproducts');
    }
};
