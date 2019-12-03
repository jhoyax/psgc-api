<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('city_id')->default(0);
            $table->unsignedBigInteger('municipality_id')->default(0);
            $table->unsignedBigInteger('sub_municipality_id')->default(0);
            $table->string('code');
            $table->string('name');
            $table->enum('area_type', ['urban', 'rural']);
            $table->integer('population')->default(0);
            $table->timestamps();

            // $table->foreign('city_id')->references('id')->on('cities');
            // $table->foreign('municipality_id')->references('id')->on('municipalities');
            // $table->foreign('sub_municipality_id')->references('id')->on('sub_municipalities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangays');
    }
}
