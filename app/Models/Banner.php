<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';
    protected $fillable = [
        'team_id',
        'judul',
        'keterangan',
        'gambar',
        'is_active',
    ];

    protected $dates = ['published_at'];

    protected $casts = [
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    // Scope untuk banner aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
