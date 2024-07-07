<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $table = 'tbl__expenses';
    protected $id = 'id';
    protected $fillable = [
        'E_Name', 'E_Type', 'E_Description', 'E_Amount',
    ];
    use HasFactory;
}
