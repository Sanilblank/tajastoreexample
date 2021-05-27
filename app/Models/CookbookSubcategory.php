<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookbookSubcategory extends Model
{
    use HasFactory;
    protected $fillable =[
            'cookbooknavbar_id',
            'cookbookcategory_id',
            'subcategory',
            'slug',
            'image',
            'status',
    ];

    public function navbar()
    {
        return $this->belongsTo(CookbookNavbar::class, 'cookbooknavbar_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(CookbookCategory::class, 'cookbookcategory_id', 'id');
    }
}
