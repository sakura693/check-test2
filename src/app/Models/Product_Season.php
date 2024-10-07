<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Season extends Model
{
    use HasFactory;

    protected $table = 'product_season'; /*テーブル名が「Product_Seasons」じゃなくて単数形の「Product_Season」だと明記する*/
}
