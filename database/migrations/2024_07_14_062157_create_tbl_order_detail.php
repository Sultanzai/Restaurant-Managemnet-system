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
        Schema::create('tbl_order_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('OD_Units');
            $table->decimal('OD_Price', 8, 2);
            $table->unsignedBigInteger('Order_ID'); // Use unsignedBigInteger for foreign key Order ID
            $table->unsignedBigInteger('Menu_ID'); // Use unsignedBigInteger for foreign key Menu ID

            $table->foreign('Order_ID')->references('id')->on('tbl_order')->onDelete('cascade'); // Define foreign key constraint Order ID
            $table->foreign('Menu_ID')->references('id')->on('tbl__menus')->onDelete('cascade'); // Define foreign key constraint Menu ID 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_order_detail');
    }
};
