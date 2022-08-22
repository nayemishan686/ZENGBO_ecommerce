<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Reviews extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'review',
        'review_date',
        'review_month',
        'review_year',
    ];

    // user table join
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    // product table join
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
