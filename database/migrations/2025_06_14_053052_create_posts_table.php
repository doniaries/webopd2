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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->string('featured_image')->nullable()->comment('Gambar utama/cover');
            $table->json('gallery_images')->nullable()->comment('Daftar path gambar tambahan');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->dateTime('published_at')->nullable();
            $table->integer('views')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();

            // Add composite unique constraint for team_id and slug
            $table->unique(['team_id', 'slug', 'title']);

            // Add indexes for better performance
            $table->index('title');
            $table->index('status');
            $table->index('published_at');
            $table->index('created_at');
            $table->index('updated_at');
            $table->index('category_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
