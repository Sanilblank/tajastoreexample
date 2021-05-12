<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $casts = [
        'category'=>'array',
    ];

    protected $fillable = ['title', 'image', 'category', 'date', 'details', 'view_count', 'authorname', 'authorimage'];
}
