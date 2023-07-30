<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('card_id');
            $table->string('name');
            $table->string('last_name');
            $table->string('citizens');
            $table->string('passport_id');
            $table->timestamp('issue_date');
            $table->timestamp('end_date')->nullable()->default(null);
            $table->string('issued_by');
            $table->timestamp('birth_day_at')->nullable()->default(null);
            $table->string('sex');
            $table->string('phone_number');
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
        Schema::dropIfExists('passengers');
    }
}
