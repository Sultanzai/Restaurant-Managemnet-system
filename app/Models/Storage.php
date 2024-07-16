<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $table = 'tbl_storage';

    protected $fillable = [
        's_Name',
    ];

    public function details()
    {
        return $this->hasMany(StorageDetail::class, 'Storage_ID', 'id');
    }
}
