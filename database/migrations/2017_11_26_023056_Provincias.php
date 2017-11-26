<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Provincias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
             Schema::create('Provincias', function(Blueprint $table) {
            $table->increments('id')->uniqid();
            $table->string('CodigoProvincias');
            $table->integer('idpais')->unsigned();
            $table->foreign('idpais')->references('id')->on('Pais');
            $table->string('NombreProvincias');
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
