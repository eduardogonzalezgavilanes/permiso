<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cantones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('Cantones', function(Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('CodigoCantones');
            $table->integer('idprovincias')->unsigned();
            $table->foreign('idprovincias')->references('id')->on('Provincias');
            $table->string('NombreCantones');
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
        //
    }
}
