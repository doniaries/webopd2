<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PostCategories extends Model
{
    protected $table = 'post_categories';
    protected $fillable = [
        'team_id',
        'post_id',
        'category_id',
    ];

    public function post(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
