<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('addresses', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->string('address1');
          $table->string('address2');
          $table->string('city');
          $table->string('state');
          $table->string('zipcode');
          $table->string('phone_number');
          $table->timestamps();
          $table->softDeletes();

          $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            Schema::dropIfExists('addresses');
        });
    }
}
