<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateICategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_categorias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('icat_us_id');
            $table->timestamps();
            $table->string('icat_nombre');
            $table->text('icat_descripcion');
            $table->boolean('icat_activo')->default('1');
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
