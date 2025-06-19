<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{
    /**
     * Handle the Post "creating" event.
     */
    public function creating(Post $post): void
    {
        if (empty($post->slug)) {
            $post->slug = Str::slug($post->title);
        }

        $this->makeSlugUnique($post);

        if ($post->status === 'published' && !$post->published_at) {
            $post->published_at = now();
        }
    }

    /**
     * Handle the Post "updating" event.
     */
    public function updating(Post $post): void
    {
        if ($post->isDirty('title')) {
            $post->slug = Str::slug($post->title);
            $this->makeSlugUnique($post, true);
        }

        if ($post->isDirty('status') && $post->status === 'published' && !$post->published_at) {
            $post->published_at = now();
        }
    }

    /**
     * Make the slug unique for the team.
     */
    protected function makeSlugUnique(Post $post, bool $updating = false): void
    {
        $originalSlug = $post->slug;
        $count = 1;

        $query = Post::where('team_id', $post->team_id)
            ->where('slug', $post->slug);

        if ($updating) {
            $query->where('id', '!=', $post->id);
        }

        while ($query->exists()) {
            $post->slug = $originalSlug . '-' . $count++;
            $query->where('slug', $post->slug);
        }
    }
}
