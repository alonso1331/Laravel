<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name', 'descripte', 'price', 'image_url', 'product_category_id'];

    // 關聯性資料表的用法，當資料表彼此有關聯時，用這個方法在controller找資料時，會比較便利
    public function productImages()
    {
        // HasMany 帶的三個參數：跟本Model要建立的相對的Model名稱，對方有關聯的欄位，自己與對方有關聯的欄位
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function productCategories()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

}
