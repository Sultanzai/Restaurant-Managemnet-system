<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_billdetail';

    protected $fillable = [
        'BD_Name', 'BD_Price', 'BD_Unit', 'Bill_ID'
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'Bill_ID');
    }
}
