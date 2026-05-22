<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
    'name',
    'quantity',
    'price',
    'category_id'
];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}