<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageView extends Model
{    
    protected $table = 'storage_view';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'storage_id',
        's_Name',
        's_Unit',
        's_Type',
        's_Price',
        's_Status',
        'created_at',
    ];
    use HasFactory;
}
