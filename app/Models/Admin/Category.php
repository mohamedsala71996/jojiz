<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory;
    use HasSlug;

    protected $guarded = ['id'];
    protected $casts = [
        'category_name' => 'string',
        'slug' => 'string',
        'image' => 'string',
        'status' => 'boolean',
        'category_desc' => 'string',
    ];

    public function subcategoris()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function childcategories()
    {
        return $this->hasMany(Childcategory::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('category_name')
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
