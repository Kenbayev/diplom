<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('aircraft'); // название саиолета
            $table->string('airlines'); // название авиакомпаний 
            $table->integer('flight_code'); // номер рейса
            $table->string('flight_from_country');
            $table->string('flight_from_city'); 
            $table->string('flight_from_city_iso');  // вылет с
            $table->string('flight_to_country');
            $table->string('flight_to_city');
            $table->string('flight_to_city_iso'); // куда
            $table->integer('flying_time'); // время полета
            $table->string('departure_date_at'); // дата и время вылета
            $table->string('arrival_date_at'); // дата и время прибытья
            $table->integer('f_class');
            $table->integer('b_class');
            $table->integer('e_class'); // кол-во мест на рейсе
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
