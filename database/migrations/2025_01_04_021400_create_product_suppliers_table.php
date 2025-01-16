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
            Schema::create('products_suppliers', function (Blueprint $table) {
                $table->id();
                $table->integer('id_supplier');
                $table->string('product_name', 25)->unique();
                $table->text('description');
                $table->integer('price');
                $table->integer('stock');
                $table->string('image');
                $table->timestamps();
                $table->softDeletes();
            });
        }
 
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('products_suppliers');
        }
    };
