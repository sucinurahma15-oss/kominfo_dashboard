<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('social_media_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('social_media_account_id')->constrained()->onDelete('cascade');
            $table->integer('followers')->default(0);
            $table->integer('following')->default(0);
            $table->integer('posts_count')->default(0);
            $table->integer('engagement')->default(0);
            $table->decimal('engagement_rate', 5, 2)->default(0);
            $table->date('record_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_media_statistics');
    }
};