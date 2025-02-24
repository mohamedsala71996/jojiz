<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class SubCategory extends Model
{
    use HasFactory;
    use HasSlug;

    protected $guarded = ['id'];
    protected $casts = [
        'category_id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'image' => 'string',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyNameCategory()
    {
        return 'slug';
    }
}
