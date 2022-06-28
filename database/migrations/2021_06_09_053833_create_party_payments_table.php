<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartypaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('party_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('party_id');
            $table->integer('amount');
            $table->integer('mode');
            $table->string('detail')->nullable();
            $table->timestamps();
            $table->timestamp("deleted_at")->nullable();

            $table->foreign('party_id')->references('id')->on('parties');
        });
    }

    public function down()
    {
        Schema::dropIfExists('party_payments');
    }
}
