<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'sale', 'hot', 'discribe', 'img', 'content'
    , 'status', 'toyal_pay', 'total_rating', 'total_stars','category_id'];
    public function ReferencesCategory() {
        return $this->hasOne(Category::class,'id','category_id');
    }
}
