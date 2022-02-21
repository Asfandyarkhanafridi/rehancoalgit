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
            $table->unsignedBigInteger('sale_id')->nullable();
            $table->integer('credit');
            $table->integer('debit');
            $table->string('status');
            $table->integer('amount');
            $table->integer('mode');
            $table->string('detail');
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
