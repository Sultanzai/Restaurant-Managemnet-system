<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_billdetail', function (Blueprint $table) {
            $table->id();
            $table->string('BD_Name');
            $table->decimal('BD_Price', 10, 2);
            $table->integer('BD_Unit');
            $table->foreignId('Bill_ID')->constrained('tbl_bill')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_billdetail');
    }
};
