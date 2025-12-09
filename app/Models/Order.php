<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

// class Order extends Model
// {
//     use HasFactory;

//     protected $fillable = ['user_id', 'total_price', 'status', 'shipping_address', 'payment_method'];

//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }

//     public function items()
//     {
//         return $this->hasMany(OrderItem::class);
//     }

//     public function transaction()
//     {
//         return $this->hasOne(Transaction::class);
//     }
// }



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'first_name',
        'last_name',
        'address',
        'phone',
        'city',
        'state',
        'postal_code',
        'email',
        'subtotal',
        'shipping_fee',
        'tax',
        'total',
        'status',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
