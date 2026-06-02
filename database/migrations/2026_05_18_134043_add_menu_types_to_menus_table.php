<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {

            $table->string('type')
                ->default('custom')
                ->after('url');

            $table->unsignedBigInteger('reference_id')
                ->nullable()
                ->after('type');

            $table->string('model_type')
                ->nullable()
                ->after('reference_id');

            $table->string('target')
                ->default('_self')
                ->after('model_type');

        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {

            $table->dropColumn([
                'type',
                'reference_id',
                'model_type',
                'target'
            ]);

        });
    }
};