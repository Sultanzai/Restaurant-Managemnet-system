<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'tbl__menus';
    protected $id = 'id';
    protected $fillable = [
        'm_Name', 'm_Price', 'm_category'
    ];
    use HasFactory;
}
