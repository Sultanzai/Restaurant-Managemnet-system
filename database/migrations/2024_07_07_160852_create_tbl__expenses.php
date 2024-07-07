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
        Schema::create('tbl__expenses', function (Blueprint $table) {
            $table->id();
            $table->String("E_Name");
            $table->string("E_Type");
            $table->string("E_Description");
            $table->integer("E_Amount");
            $table->timestamps();
        });
    }             

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl__expenses');
    }
};
