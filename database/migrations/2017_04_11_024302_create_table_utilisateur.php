<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUtilisateur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateurs', function(Blueprint $table) {
            $table->increments('idutilisateur');
            $table->string('email', 50);
            $table->string('lastname', 50);
            $table->string('firstname', 50);
            $table->integer('nCapsule')->default(0);
            $table->string('password');
            $table->boolean('isAdmin');
            $table->string('nCarte', 255)->unique();
            $table->string('nCarteHash', 255);
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
        Schema::drop('utilisateurs');
    }
}
