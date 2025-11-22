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
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('content', 280); // Requirement: Max 280 chars [cite: 19]
            $table->boolean('is_edited')->default(false); // Requirement: Edited indicator [cite: 29]
            // Future-proofing for sorting/analytics
            $table->unsignedBigInteger('likes_count')->default(0)->index();
            $table->timestamps(); // Includes created_at for sorting [cite: 25]
            $table->softDeletes(); // Requirement: Remove from DB, but safer to soft delete first [cite: 33]

            // Index for faster sorting by newest
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tweets');
    }
};
