<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'tbl_bill';

    protected $fillable = [
        'B_Number', 'B_Name', 'B_Total', 'B_Paid', 'B_Description', 
    ];
    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function billDetails()
    {
        return $this->hasMany(BillDetail::class, 'Bill_ID');
    }
}
