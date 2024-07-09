<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageView extends Model
{    
    protected $table = 'storage_details_view';
    protected $primaryKey = 'detail_id';
    public $timestamps = false;

    protected $fillable = [
        'storage_name',
        'unit',
        'type',
        'price',
        'status',
        'storage_id',
    ];
    use HasFactory;
}
