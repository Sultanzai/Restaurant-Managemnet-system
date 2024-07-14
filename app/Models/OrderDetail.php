<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'tbl_order_detail';

    protected $fillable = [
        'OD_Units',
        'OD_Price',
        'Order_ID',
        'Menu_ID',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'Order_ID');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'Menu_ID');
    }
}
