<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTaxCall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_call', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price_per_minute');

            $table->integer('ddd_source_id');
            $table->foreign('ddd_source_id')
                ->references('id')
                ->on('area_code')->onDelete('cascade');

            $table->integer('ddd_destiny_id');
            $table->foreign('ddd_destiny_id')
                ->references('id')
                ->on('area_code')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_call');
    }
}
