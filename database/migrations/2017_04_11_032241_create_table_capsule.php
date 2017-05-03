<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCapsule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capsules', function(Blueprint $table) {
            $table->increments('idcapsule');
            $table->string('libelle', 50);
            $table->integer('numbers')->default(0);
            $table->binary('picture')->nullable();
            $table->integer('typeCapsule')->unsigned();

            $table->foreign('typeCapsule')->references('idtypeCapsule')->on('typeCapsules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('capsules');
    }
}
