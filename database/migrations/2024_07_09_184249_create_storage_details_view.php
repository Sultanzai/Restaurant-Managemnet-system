<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW storage_details_view AS
            SELECT
                sd.id AS detail_id,
                s.s_Name AS storage_name,
                sd.S_Unit AS unit,
                sd.S_Type AS type,
                sd.S_Price AS price,
                sd.S_Status AS status,
                sd.Storage_ID AS storage_id
            FROM
                tbl_storage s
            JOIN
                tbl_storage__detail sd ON s.id = sd.Storage_ID
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS storage_details_view");
    }
};
