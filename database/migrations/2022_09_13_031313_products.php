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
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id',true,false);
            $table->string('productName');
            $table->string('price');
            $table->string('discount')->default(0);
            $table->string('summary');
            $table->text('content');
            $table->integer('status')->default(0);
            $table->integer('prodType',false,false);
            $table->foreign('prodType')->references('id')->on('prodType');
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
        Schema::dropIfExists('products');
    }
};
