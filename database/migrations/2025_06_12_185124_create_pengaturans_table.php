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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->string('nama_website')->nullable();
            $table->string('logo_instansi')->nullable();
            $table->string('favicon_instansi')->nullable();
            $table->string('kepala_instansi')->nullable();
            $table->string('alamat_instansi')->nullable();
            $table->string('no_telp_instansi')->nullable();
            $table->string('email_instansi')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->timestamps();


            $table->unique(['team_id', 'nama_website']);
            $table->index('team_id');
            $table->index('nama_website');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};
