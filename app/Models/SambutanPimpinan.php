<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SambutanPimpinan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sambutan_pimpinans';
    
    protected $fillable = [
        'team_id',
        'isi_sambutan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the team that owns the sambutan pimpinan.
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the active sambutan pimpinan for the current team.
     *
     * @return \App\Models\SambutanPimpinan|null
     */
    public static function getActive()
    {
        $teamId = Auth::check() ? Auth::user()->current_team_id : null;
        
        if (!$teamId) {
            return null;
        }
        
        return static::where('team_id', $teamId)
            ->latest()
            ->first();
    }
}
