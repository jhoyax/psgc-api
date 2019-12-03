<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('province_id')->default(0);
            $table->unsignedBigInteger('district_id')->default(0);
            $table->string('code');
            $table->string('name');
            $table->string('city_class')->nullable();
            $table->string('income_classification')->nullable();
            $table->integer('population')->default(0);
            $table->timestamps();

            // $table->foreign('province_id')->references('id')->on('provinces');
            // $table->foreign('district_id')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
