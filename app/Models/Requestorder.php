<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Requestorder extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
            'name',
            'phone',
            'address',
            'email',
            'product',
            'description',
            'status',
    ];
}
