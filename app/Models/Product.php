<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @property string product_name
     * @property longText product_description
     * @property decimal product_price
     * @property decimal offer_price
     * @property integer product_quantity
     * @property unsignedBigInteger category_id
     * @property unsignedBigInteger sub_category_id
     * @property unsignedBigInteger brand_id
     * @property tinyInteger status
     *
     */
    protected $fillable = [
        'product_name', 'product_description', 'product_price','offer_price','product_quantity','category_id','sub_category_id','brand_id','status',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function sub_category()
    {
        return $this->belongsTo(Sub_category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
