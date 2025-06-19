<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaKegiatan extends Model
{
    protected $table = 'agenda_kegiatans';

    protected $fillable = [
        'team_id',
        'nama_agenda',
        'uraian_agenda',
        'tempat',
        'dari_tanggal',
        'sampai_tanggal',
    ];

    protected $dates = ['published_at'];

    protected $casts = [
        'published_at' => 'datetime',
        'dari_tanggal' => 'datetime',
        'sampai_tanggal' => 'datetime',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
