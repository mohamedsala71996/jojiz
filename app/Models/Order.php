<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    
    public function orderproducts()
    {
        return $this->hasMany(Orderproduct::class, 'order_id');
    }
    public function ordernotes()
    {
        return $this->hasOne('App\Models\Ordernote', 'order_id', 'id')->latest();
    }

    public function customers()
    {
        return $this->hasOne(Customer::class, 'order_id');
    }

    public function admins()
    {
        return $this->belongsTo(Admin\Admin::class, 'admin_id');
    }
    public function couriers()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }

    public function products()
    {
        return $this->belongsTo(Admin\Product::class, 'product_id');
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function zones()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function areas()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'web_id' => 'integer',
        'user_id' => 'integer',
        'courier_id' => 'integer',
        'city_id' => 'integer',
        'zone_id' => 'integer',
        'area_id' => 'integer',
        'subTotal' => 'integer',
        'shippingCharge' => 'integer',
        'discount' => 'integer',
        'total' => 'integer',
        'vat' => 'integer',
        'tax' => 'integer',
        'paidAmount' => 'integer',
        'orderDate' => 'date',
        'confirmDate' => 'date',
        'shippingDate' => 'date',
        'deliveryDate' => 'date',
        'admin_id' => 'integer',
        'seller_id' => 'integer',
        'payment_id' => 'integer',
        'amount' => 'float',
        'transaction_id' => 'string',
        'currency' => 'string',
        'status' => 'string',
        'payment_status' => 'string',
        'payment_method' => 'string',
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'address' => 'string',
        'country' => 'string',
        'city' => 'string',
        'district' => 'string',
        'state' => 'string',
        'zip_code' => 'string',
        'order_note' => 'string',
        'note' => 'string',
        'coupon' => 'string',
        'advance_payment_amount' => 'decimal:2',
        'advance_payment_status' => 'string',
    ];
}
