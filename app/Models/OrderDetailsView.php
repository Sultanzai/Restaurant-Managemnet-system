<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailsView extends Model
{
   // Specify the table name
   protected $table = 'order_details_view';

   // Disable timestamps for this model
   public $timestamps = false;
}
