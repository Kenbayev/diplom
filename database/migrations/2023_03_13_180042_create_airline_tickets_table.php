<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirlineTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airline_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('flight_code');
            $table->string('airlines');
            $table->string('aircraft');
            $table->string('departure_date_at');
            $table->string('arrival_date_at');
            $table->string('flight_from_city_iso');
            $table->string('flight_to_city_iso');
            $table->string('number_seats');
            $table->string('ticket_token');
            $table->string('ticket_qr_token');
            $table->string('ticket_url');
            $table->string('ticket_qr_url');
            $table->integer('passenger_id');
            $table->boolean('ticket_status');
            $table->integer('payment_id');
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
        Schema::dropIfExists('airline_tickets');
    }
}
