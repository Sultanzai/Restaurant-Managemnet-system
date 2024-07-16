<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_storage__detail';

    protected $fillable = [
        'id',
        'S_Unit',
        'S_Type',
        'S_Price',
        'S_Status',
        'Storage_ID',
    ];

    public function storage()
    {
        return $this->belongsTo(Storage::class, 'Storage_ID', 'id');
    }
}
