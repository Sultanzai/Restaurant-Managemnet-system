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
        Schema::create('tbl_storage__detail', function (Blueprint $table) {
            $table->id();
            $table->integer('S_Unit');
            $table->string('S_Type');
            $table->integer('S_Price');
            $table->string('S_status');
            $table->unsignedBigInteger('Storage_ID'); // Use unsignedBigInteger for foreign key

            $table->foreign('Storage_ID')->references('id')->on('tbl_storage')->onDelete('cascade'); // Define foreign key constraint
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_storage__detail');
    }
};
