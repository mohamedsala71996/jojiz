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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // product info
            $table->string('product_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('product_sku')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories')->nullOnDelete();
            $table->foreignId('child_category_id')->nullable()->constrained('child_categories')->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->longText('product_description')->nullable();
            $table->string('gander')->nullable();
            $table->string('youtube_embadecode')->nullable();
            $table->string('type')->default('new_arrival');
            // shipment
            $table->string('shipping_type')->nullable();
            $table->integer('shippig_cost')->nullable();
            $table->longText('shipping_rtn_policy')->nullable();
            // offers
            $table->date('offer_start')->nullable();
            $table->date('offer_end')->nullable();
            $table->integer('discount_percent')->default(0);
            $table->string('multiple_qty')->nullable();
            //offer collection
            $table->integer('collection_id')->nullable();
            $table->string('collection_name')->nullable();
            // seo
            $table->string('meta_name')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_image')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();
            // stock
            $table->integer('total_stock')->default(0);
            $table->integer('available')->default(0);
            $table->integer('sold')->default(0);
            $table->string('status')->default('Draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
