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
        Schema::create('agenda_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->string('nama_agenda')->nullable();
            $table->text('uraian_agenda')->nullable();
            $table->string('tempat')->nullable();
            $table->date('dari_tanggal')->nullable();
            $table->date('sampai_tanggal')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Add composite unique constraint for team_id and nama_agenda
            $table->unique(['team_id', 'nama_agenda']);
            
            // Add indexes for better performance
            $table->index('team_id');
            $table->index('nama_agenda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_kegiatans');
    }
};
