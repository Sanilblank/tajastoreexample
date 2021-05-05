<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable =[
            'sitename',
            'headerImage',
            'footerImage',
            'facebook',
            'linkedin',
            'youtube',
            'instagram',
            'aboutus',
            'address',
            'phone',
            'email',
    ];
}
