<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    use HasFactory;

    protected $table = 'visi_misis';

    protected $fillable = [
        'team_id',
        'visi',
        'misi'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
