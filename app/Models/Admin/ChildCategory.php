<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ChildCategory extends Model
{
    use HasFactory;
    use HasSlug;

    protected $guarded = ['id'];
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
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

    protected $casts = [
        'subcategory_id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'image' => 'string',
        'status' => 'boolean',
    ];
}
