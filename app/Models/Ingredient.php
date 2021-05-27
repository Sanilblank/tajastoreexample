<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    protected $fillable = [
            'cookbookitem_id',
            'product_id',
            'item',
    ];

    public function cookbookitem()
    {
        return $this->belongsTo(CookbookItem::class, 'cookbookitem_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
