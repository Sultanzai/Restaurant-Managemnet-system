<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'tbl_order';
    protected $id = 'id';
    protected $fillable = [
        'O_Name', 'O_Status', 'O_Description'
    ];
    use HasFactory;
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'Order_ID');
    }
}
