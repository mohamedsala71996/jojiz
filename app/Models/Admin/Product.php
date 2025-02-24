<?php

namespace App\Models\Admin;

use App\Models\Offer;
use App\Models\Orderproduct;
use App\Models\Size;
use App\Models\User;
use App\Models\Weight;
use App\Models\Wishlist;
use Spatie\Sluggable\HasSlug;
use App\Models\Productvariation;
use App\Models\ProductVariationImage;
use App\Models\Review;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use HasSlug;

    protected $guarded = ['id'];

    protected $casts = [
        'product_name' => 'string',
        'slug' => 'string',
        'product_name' => 'string',
        'product_sku' => 'string',
        'category_id' => 'integer',
        'sub_category_id' => 'integer',
        'child_category_id' => 'integer',
        'brand_id' => 'integer',
        'product_description' => 'string',
        'gander' => 'string',
        'youtube_embadecode' => 'string',
        'type' => 'string',
        'shipping_type' => 'string',
        'shippig_cost' => 'integer',
        'shipping_rtn_policy' => 'string',
        'offer_start' => 'date',
        'offer_end' => 'date',
        'discount_percent' => 'float',
        'multiple_qty' => 'string',
        'meta_name' => 'string',
        'meta_title' => 'string',
        'meta_image' => 'string',
        'meta_keywords' => 'string',
        'meta_description' => 'string',
        'total_stock' => 'integer',
        'available' => 'integer',
        'sold' => 'integer',
        'status' => 'string',
        'advance_payment_amount' => 'decimal:2',
        'purchase_amount' => 'decimal:2',
        'supplier_id' => 'integer',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function productvariations()
    {
        return $this->hasMany(Productvariation::class);
    }
    public function productVariationImages()
    {
        return $this->hasMany(ProductVariationImage::class);
    }

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }
    public function weights()
    {
        return $this->hasMany(Weight::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('product_name')
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

    function offers(){
        return $this->belongsToMany(Offer::class);
    }

    public function orderproducts(){
        return $this->hasMany(Orderproduct::class);
    }
    
}
