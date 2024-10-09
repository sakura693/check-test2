<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description'
    ];

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season', 'product_id', 'season_id');
    }

    public function scopeProductSearch($query, $product_id)
    {
        if(!empty($product_id)){
            $query->where('product_id', $product_id);
        }
        return $query;
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if(!empty($keyword))
        {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
        return $query;
    }
}
