<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('brand_id'); #marca
            $table->string('photo');
            $table->string('name');
            $table->mediumText('excerpt'); #extracto
            $table->text('description');
            $table->double('price', 8,2); #20'000.000.00
            $table->bigInteger('stock');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('brand_id')->references('id')->on('brands');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
