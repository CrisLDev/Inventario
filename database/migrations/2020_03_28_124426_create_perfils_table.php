<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfils', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('us_id');
            $table->string('imgurl')->default('public/imgs/no-image.jpg');
            $table->string('nombres');
            $table->string('apellidos');
            $table->integer('edad');
            $table->string('direccion');
            $table->integer('ntelefono');
            $table->boolean('activo')->default('1');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfils');
    }
}
