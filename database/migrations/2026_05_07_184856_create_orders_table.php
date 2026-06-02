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
       Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable(); // null for guest checkout
            $table->string('billing_firstname');
            $table->string('billing_lastname');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_zipcode');
            $table->string('billing_phone');
            $table->string('billing_email');
            $table->decimal('total', 10, 2)->default(0);
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
