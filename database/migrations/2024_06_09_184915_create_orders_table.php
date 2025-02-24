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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceID');
            $table->integer('web_id')->default(0);
            $table->string('user_id')->nullable();
            $table->text('note')->nullable();
            $table->integer('courier_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('zone_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->string('hub_name')->nullable();
            // $table->string('address')->nullable();
            $table->integer('subTotal');
            $table->integer('shippingCharge')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('total')->default(0);
            $table->integer('vat')->default(0);
            $table->integer('tax')->default(0);
            $table->string('coupon')->nullable();
            $table->integer('paidAmount')->default(0);
            $table->date('orderDate');
            $table->date('confirmDate')->nullable();
            $table->date('shippingDate')->nullable();
            $table->date('deliveryDate')->nullable();
            $table->string('status')->default('Pending');
            $table->string('payment_status')->default('due');
            $table->integer('admin_id');
            $table->integer('seller_id')->nullable();
            $table->integer('payment_id')->nullable();
            $table->string('payment_method')->default('cash_on_delivery');
            //shipping address
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->text('order_note')->nullable();

            $table->text('amount')->nullable();
            $table->text('transaction_id')->nullable();
            $table->text('currency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
