<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\PostTag;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'team_id',
        'title',
        'slug',
        'content',
        'category_id',
        'user_id',
        'status',
        'published_at',
        'views',
        'featured_image',
        'gallery_images'
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'published_at' => 'datetime',
        'views' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected $appends = ['featured_image_url', 'gallery_images_urls', 'excerpt'];

    /**
     * Get the URL for the featured image.
     *
     * @return string|null
     */


    /**
     * Get the gallery images with full URLs
     *
     * @return array
     */
    public function getGalleryImagesUrlsAttribute()
    {
        if (empty($this->gallery_images)) {
            return [];
        }

        $photos = is_array($this->gallery_images) ? $this->gallery_images : json_decode($this->gallery_images, true);

        if (!is_array($photos)) {
            return [];
        }

        return collect($photos)->map(function ($photo) {
            if (filter_var($photo, FILTER_VALIDATE_URL)) {
                return $photo;
            }

            $imagePath = trim($photo, '/');
            if (Storage::disk('public')->exists($imagePath)) {
                return asset('storage/' . $imagePath);
            }

            if (strpos($imagePath, 'gallery-images/') === false) {
                $imagePath = 'gallery-images/' . $imagePath;
                if (Storage::disk('public')->exists($imagePath)) {
                    return asset('storage/' . $imagePath);
                }
            }

            return $photo; // Return as is if not found in storage
        })->toArray();
    }

    /**
     * Get the excerpt of the post content.
     *
     * @return string
     */
    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 200);
    }

    /**
     * Get the categories for the post.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'category_id');
    }


    /**
     * Get the team that owns the post.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }


    /**
     * Get the featured images for the post.
     */
    public function featuredImages(): HasMany
    {
        return $this->images()->where('is_featured', true);
    }

    /**
     * Get the category that owns the post.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * Get the user that owns the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Scope a query to only include published posts.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include featured posts.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include posts from a specific category.
     */
    public function scopeInCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope a query to order posts by most viewed.
     */
    public function scopeMostViewed($query, $limit = 5)
    {
        return $query->orderBy('views', 'desc')->limit($limit);
    }

    /**
     * Scope a query to order posts by latest.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Increment the view count for the post.
     */
    public function incrementViewCount()
    {
        $this->increment('views');
    }

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            // If it's already a full URL, return as is
            if (filter_var($this->featured_image, FILTER_VALIDATE_URL)) {
                return $this->featured_image;
            }

            // Ensure the path is relative to storage
            $imagePath = trim($this->featured_image, '/');

            // Check if file exists in storage
            if (Storage::disk('public')->exists($imagePath)) {
                return asset('storage/' . $imagePath);
            }


            // If not found, try in featured-images directory
            if (strpos($imagePath, 'featured-images/') === false) {
                $imagePath = 'featured-images/' . $imagePath;
                if (Storage::disk('public')->exists($imagePath)) {
                    return asset('storage/' . $imagePath);
                }
            }
        }

        return null;
    }

    /**
     * Get the tags for the post.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id')
            ->withPivot('team_id')
            ->withTimestamps();
    }
    // Event handling moved to PostObserver
}
