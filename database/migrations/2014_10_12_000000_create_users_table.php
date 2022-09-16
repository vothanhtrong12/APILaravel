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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id',true,false);
            $table->string('username');
            $table->string('password');
            $table->string('password2')->nullable();
            $table->string('fullName')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('ggId')->nullable();
            $table->integer('idRole',false,false);
            $table->integer('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('idRole')->references('id')->on('userRole');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
