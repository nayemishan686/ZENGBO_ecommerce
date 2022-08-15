<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Warehouse;
use App\Models\Brand;
use App\Models\PickupPoint;

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

    // Category join
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    //SubCategory Join
    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    //SubCategory Join
    public function childcategory(){
        return $this->belongsTo(ChildCategory::class, 'childcategory_id');
    }

    //SubCategory Join
    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    //SubCategory Join
    public function warehouse(){
        return $this->belongsTo(Warehouse::class, 'warehouse');
    }

    //SubCategory Join
    public function pickuppoint(){
        return $this->belongsTo(PickupPoint::class, 'pickup_point');
    }
}
