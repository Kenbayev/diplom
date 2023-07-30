<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditCardInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_card_information', function (Blueprint $table) {
            $table->id();
            $table->integer('passenger_id');
            $table->integer('credit_card_numer');
            $table->string('date_end_at');
            $table->string('name');
            $table->string('last_name');
            $table->integer('csv_number');
            $table->boolean('card_status');
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
        Schema::dropIfExists('credit_card_information');
    }
}
