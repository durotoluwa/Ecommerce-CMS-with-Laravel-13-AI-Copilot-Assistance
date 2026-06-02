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

            // Core product info
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // Pricing
            $table->decimal('regular_price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();

            // Inventory
            $table->string('sku')->unique()->nullable();
            $table->enum('stock_status', ['in_stock', 'out_of_stock', 'on_backorder'])->default('in_stock');
            $table->unsignedInteger('stock_quantity')->default(0);

            // SEO
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();

            // Status & publishing
            $table->enum('status', ['active', 'pending', 'draft'])->default('active');
            $table->enum('publish_type', ['immediately', 'schedule'])->default('immediately');
            $table->dateTime('publish_date')->nullable();

            // Feature image / gallery
            $table->string('thumbnail')->nullable();
            $table->json('gallery')->nullable();

            $table->timestamps();
        });

        // Pivot tables for relationships
        Schema::create('brand_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
        });

        Schema::create('attribute_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('term_id')->nullable()->constrained('attribute_terms')->onDelete('set null');
            $table->boolean('visible')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_product');
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('brand_product');
        Schema::dropIfExists('products');
    }
};
