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
        Schema::create('blog_post', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('content');
        $table->unsignedBigInteger('blog_category_id');
        $table->string('featured_image')->nullable();
        $table->enum('publish_type', ['draft', 'published'])->default('draft');
        $table->date('publish_date')->nullable();
        $table->enum('status', ['active', 'hidden'])->default('active');
        $table->string('short_description', 200)->nullable();
        $table->string('seo_keywords')->nullable();
        $table->string('seo_description', 160)->nullable();
        $table->timestamps();

        $table->foreign('blog_category_id')
              ->references('id')->on('blog_categories')
              ->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_post');
    }
};
