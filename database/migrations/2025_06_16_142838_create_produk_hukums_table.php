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
        Schema::create('produk_hukums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->string('judul');
            $table->string('slug')->unique()->nullable();
            $table->text('uraian')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['team_id', 'judul', 'file', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_hukums');
    }
};
