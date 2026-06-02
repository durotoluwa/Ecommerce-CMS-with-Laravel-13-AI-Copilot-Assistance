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
     Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique(); // e.g. USD, NGN
            $table->string('name');               // e.g. US Dollar, Nigerian Naira
            $table->string('symbol', 5)->nullable(); // $, ₦
            $table->decimal('rate', 15, 6)->default(1); // conversion rate relative to base
            $table->boolean('is_base')->default(false); // mark one currency as base
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
