<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CookbookItem extends Model
{
    use HasFactory;
    use Searchable;
    protected $fillable = [
            'cookbooknavbar_id',
            'cookbookcategory_id',
            'cookbooksubcategory_id',
            'itemname',
            'slug',
            'itemimage',
            'recipeby',
            'recipebyimage',
            'serving',
            'timetoprepare',
            'timetocook',
            'description',
            'course',
            'cuisine',
            'timeofday',
            'levelofcooking_id',
            'recipetype_id',
            'steps',
            'status',
    ];

    public function searchableAs()
    {
        return 'tajamandi_cookbook';
    }

    public function navbar()
    {
        return $this->belongsTo(CookbookNavbar::class, 'cookbooknavbar_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(CookbookCategory::class, 'cookbookcategory_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(CookbookSubcategory::class, 'cookbooksubcategory_id', 'id');
    }

    public function levelofcooking()
    {
        return $this->belongsTo(Levelofcooking::class, 'levelofcooking_id', 'id');
    }

    public function recipetype()
    {
        return $this->belongsTo(Recipetype::class, 'recipetype_id', 'id');
    }
}
