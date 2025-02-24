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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->integer('qty');
            $table->string('color')->nullable();
            $table->integer('color_id')->nullable();
            $table->string('size')->nullable();
            $table->integer('size_id')->nullable();
            $table->string('weight')->nullable();
            $table->integer('weight_id')->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->decimal('total', 8, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
