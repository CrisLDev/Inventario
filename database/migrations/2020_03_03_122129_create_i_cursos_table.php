<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateICursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_cursos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('icur_us_id');
            $table->timestamps();
            $table->string('icur_nombre');
            $table->text('icur_descripcion');
            $table->boolean('icur_activo')->default('1');
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
        Schema::dropIfExists('i_categorias');
    }
}
