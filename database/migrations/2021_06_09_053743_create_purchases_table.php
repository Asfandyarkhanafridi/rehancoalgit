<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('quality_id');
            $table->integer('rate');
            $table->integer('weight');
            $table->integer('load');
            $table->integer('mate');
            $table->string('detail')->nullable();
            $table->string('amount')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->timestamp("deleted_at")->nullable();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('quality_id')->references('id')->on('qualities');
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
