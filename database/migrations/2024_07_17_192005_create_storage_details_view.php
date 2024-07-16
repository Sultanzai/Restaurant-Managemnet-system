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
        DB::statement('
        CREATE VIEW storage_view AS
        SELECT 
            tbl_storage.id AS storage_id,
            tbl_storage.s_Name,
            tbl_storage__detail.id,
            tbl_storage__detail.S_Unit,
            tbl_storage__detail.S_Type,
            tbl_storage__detail.S_Price,
            tbl_storage__detail.S_Status,
            tbl_storage__detail.created_at
        FROM tbl_storage
        INNER JOIN tbl_storage__detail ON tbl_storage.id = tbl_storage__detail.Storage_ID
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storage_details_view');
    }
};
