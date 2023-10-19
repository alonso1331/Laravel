<?php

namespace App\Models;

use App\Models\StoreArea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';

    protected $fillable = ['store_area_id', 'name', 'phone', 'address', 'image_url'];

    public function storeAreas()
    {
        return $this->belongsTo(StoreArea::class, 'store_area_id', 'id');
    }
}
