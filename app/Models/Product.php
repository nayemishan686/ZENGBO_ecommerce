<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'childcategory_id',
        'brand_id',
        'warehouse',
        'admin_id',
        'pickup_point',
        'name',
        'code',
        'unit',
        'tags',
        'purchase_price',
        'selling_price',
        'discount_price',
        'stock_quantity',
        'description',
        'thumbnail',
        'image',
        'featured',
        'today_deal',
        'status',
        'flash_deal_id',
        'cash_on_delivery',
        'color',
        'size',
    ];
}
