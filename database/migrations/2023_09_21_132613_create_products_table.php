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
            $table->uuid('category_uuid'); // Foreign key to categories.uuid
            $table->uuid('uuid')->unique(); // UUID column
            $table->string('title');
            $table->float('price');
            $table->text('description');
            $table->json('metadata'); // JSON column for metadata
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('deleted_at')->nullable(); // Nullable deleted_at field

        });

        // Add foreign key constraint
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_uuid')
                ->references('uuid')
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
