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
          Schema::create('home_category_section', function (Blueprint $table) {
            $table->id();
            $table->string('selection');
            $table->boolean('autoplay')->default(false);
            $table->integer('autoplaytimeout')->default(0);
            $table->boolean('responsive992')->default(false);
            $table->boolean('responsive576')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
   
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_category_section');
    }
};
