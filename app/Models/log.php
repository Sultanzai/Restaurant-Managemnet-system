<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'state',
        'item_name',
        'item_id',
        'price',
    ];
}
