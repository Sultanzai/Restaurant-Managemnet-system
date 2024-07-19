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
        CREATE OR REPLACE VIEW storage_main_view AS
        SELECT 
            s.id AS storage_id,
            s.s_Name,
            s.created_at,
            COALESCE(SUM(CASE WHEN sd.S_Status = 'In' THEN COALESCE(sd.S_Unit, 0) ELSE 0 END), 0) AS total_in,
            COALESCE(SUM(CASE WHEN sd.S_Status = 'Out' THEN COALESCE(sd.S_Unit, 0) ELSE 0 END), 0) AS total_out,
            COALESCE(SUM(CASE WHEN sd.S_Status = 'Expired' THEN COALESCE(sd.S_Unit, 0) ELSE 0 END), 0) AS total_expired,
            (COALESCE(SUM(CASE WHEN sd.S_Status = 'In' THEN COALESCE(sd.S_Unit, 0) ELSE 0 END), 0) -
            COALESCE(SUM(CASE WHEN sd.S_Status = 'Out' THEN COALESCE(sd.S_Unit, 0) ELSE 0 END), 0) -
            COALESCE(SUM(CASE WHEN sd.S_Status = 'Expired' THEN COALESCE(sd.S_Unit, 0) ELSE 0 END), 0)) AS final_balance
        FROM 
            tbl_storage s
        LEFT JOIN 
            tbl_storage__detail sd ON s.id = sd.Storage_ID
        GROUP BY 
            s.id, s.s_Name, s.created_at;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storage_main_view');
    }
};
