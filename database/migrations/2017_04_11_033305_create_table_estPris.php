<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEstPris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estPris', function(Blueprint $table) {
            $table->increments('idparQui');
            $table->integer('unUtilisateur')->unsigned();
            $table->integer('uneCapsule')->unsigned();

            $table->foreign('unUtilisateur')->references('idutilisateur')->on('utilisateurs');
            $table->foreign('uneCapsule')->references('idcapsule')->on('capsules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('etPris');
    }
}
