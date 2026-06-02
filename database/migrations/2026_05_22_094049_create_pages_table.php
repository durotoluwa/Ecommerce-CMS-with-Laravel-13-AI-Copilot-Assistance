<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('slug')->unique();

            $table->string('featured_image')->nullable();

            $table->enum('publish_type', ['immediately', 'schedule'])->default('immediately');
            $table->timestamp('publish_date')->nullable();
            $table->enum('status', ['active', 'pending', 'draft'])->default('draft');

            // SEO fields
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
