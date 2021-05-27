<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookbookCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'cookbooknavbar_id',
        'category',
        'status',
    ];

    public function navbar()
    {
        return $this->belongsTo(CookbookNavbar::class, 'cookbooknavbar_id', 'id');
    }
}
