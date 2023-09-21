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
        Schema::create('jwt_tokens', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id'); // Foreign key to user.id
            $table->string('unique_id');
            $table->string('token_title');
            $table->json('restrictions')->nullable(); // Nullable restrictions
            $table->json('permissions')->nullable(); // Nullable permissions
            $table->timestamps();
            $table->timestamp('expires_at')->nullable(); // Nullable expires_at
            $table->timestamp('last_used_at')->nullable(); // Nullable last_used_at
            $table->timestamp('refreshed_at')->nullable(); // Nullable refreshed_at

        });

        // Add foreign key constraint
        Schema::table('jwt_tokens', function (Blueprint $table) {
            $table->foreign('user_id')->references('uuid')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jwt_tokens');
    }
};
