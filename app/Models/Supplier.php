<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplierName',
        'supplierPhone',
        'supplierEmail',
        'supplierAddress',
        'supplierProfile',
        'supplierCompanyName',
        'supplierTotalAmount',
        'supplierPaidAmount',
        'supplierDueAmount',
        'supplierPartialAmount',
        'status',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'supplier_id');
    }
    protected $casts = [
        'supplierTotalAmount' => 'float',
        'supplierPaidAmount' => 'float',
        'supplierDueAmount' => 'float',
        'supplierPartialAmount' => 'float',
        'supplierName' => 'string',
        'supplierPhone' => 'string',
        'supplierEmail' => 'string',
        'supplierAddress' => 'string',
        'supplierProfile' => 'string',
        'supplierCompanyName' => 'string',
        'status' => 'string',
    ];
}
