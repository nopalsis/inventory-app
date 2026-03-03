<?php

namespace App\Models;

use App\Models\ProductStatement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    protected $guarded = [];

    public function statements()
{
    return $this->hasMany(ProductStatement::class);
}
}
