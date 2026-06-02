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
       Schema::create('transaction', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('order_id');
    $table->unsignedBigInteger('customer_id')->nullable();
    $table->string('payment_method');
    $table->string('reference');
    // Bank Transfer, Paystack, Rexpay
    $table->string('status')->default('pending'); // pending, paid, failed
    $table->decimal('amount', 10, 2);
    $table->timestamps();

    $table->foreign('order_id')->references('id')->on('product_order')->onDelete('cascade');
    $table->foreign('customer_id')->references('id')->on('customer')->onDelete('set null');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
