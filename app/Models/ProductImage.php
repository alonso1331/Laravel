<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'product_images';

    protected $fillable = ['product_id','image_url'];

    // 找出其他圖片的主要資料表的其他資料，但是hasOne的寫法比較不好，要用belongsto
    public function product()
    {
        // return $this->hasOne(Product::class, 'id', 'product_id');
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
