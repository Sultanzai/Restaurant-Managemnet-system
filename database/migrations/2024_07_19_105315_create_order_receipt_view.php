<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE VIEW order_receipt_view AS
        SELECT 
            o.id AS order_id,
            o.O_Name,
            o.O_Status,
            o.O_Description,
            o.created_at,
            od.OD_Units,
            od.OD_Price,
            m.m_Name
        FROM 
            tbl_order o
        JOIN 
            tbl_order_detail od ON o.id = od.Order_ID
        JOIN 
            tbl__menus m ON od.Menu_ID = m.id;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_receipt_view');
    }
};
