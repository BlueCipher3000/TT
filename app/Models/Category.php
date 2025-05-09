<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [ 'name', 'description', 'img', 'status'];

    public function ReferencesProduct() {
        return $this->hasMany(Product::class);
    }
}
