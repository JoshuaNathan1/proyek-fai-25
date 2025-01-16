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
        Schema::create('dtrans_supplier', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key
            $table->unsignedBigInteger('htrans_supplier_id'); // Foreign key ke htrans_supplier
            $table->unsignedBigInteger('product_id'); // ID produk
            $table->integer('quantity'); // Jumlah produk yang dibeli
            $table->decimal('price', 15, 2); // Harga per item
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraints
            $table->foreign('htrans_supplier_id')->references('id')->on('htrans_supplier')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products_suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtrans_supplier');
    }
};