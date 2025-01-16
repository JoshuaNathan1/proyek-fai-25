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
            Schema::create('htrans_supplier', function (Blueprint $table) {
                $table->bigIncrements('id'); // Primary key
                $table->unsignedBigInteger('admin_id'); // ID admin
                $table->unsignedBigInteger('supplier_id'); // ID supplier
                $table->decimal('total', 15, 2); // Total harga transaksi
                $table->timestamps(); // created_at and updated_at

                // Foreign key constraints
                $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('supplier_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('htrans_supplier');
        }
    };