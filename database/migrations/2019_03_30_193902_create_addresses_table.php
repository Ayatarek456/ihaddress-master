<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ih',50)->unique();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('country_id');
            $table->string('state')->nullable();
            $table->string('streetname1')->nullable();
            $table->string('streetname2')->nullable();
            $table->string('myhomeis')->nullable();
            $table->string('type')->nullable();
            $table->string('number')->nullable();
            $table->string('landmark')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->unique(['user_id', 'country_id']);
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');

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
        Schema::dropIfExists('addresses');
    }
}
