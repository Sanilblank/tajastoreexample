<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderedProducts extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'user_id',
        'order_id',
        'vendor_id',
        'product_id',
        'quantity',
        'price',
        'status_id',
        'reason'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }
}
