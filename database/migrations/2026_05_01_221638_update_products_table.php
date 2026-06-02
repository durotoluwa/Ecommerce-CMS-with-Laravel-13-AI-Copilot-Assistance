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
        Schema::table('products', function (Blueprint $table) {
            // Inventory
            $table->unsignedInteger('stock_quantity')->default(0)->after('stock_status');

            // SEO
            $table->string('seo_title')->nullable()->after('stock_quantity');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->string('seo_keywords')->nullable()->after('seo_description');

            // Status & publishing
            $table->enum('status', ['active', 'pending', 'draft'])->default('active')->after('seo_keywords');
            $table->enum('publish_type', ['immediately', 'schedule'])->default('immediately')->after('status');
            $table->dateTime('publish_date')->nullable()->after('publish_type');

            // Gallery
            $table->json('gallery')->nullable()->after('thumbnail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'stock_quantity',
                'seo_title',
                'seo_description',
                'seo_keywords',
                'status',
                'publish_type',
                'publish_date',
                'gallery',
            ]);
        });
    }
};
