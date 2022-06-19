<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanypaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('company_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->integer('amount');
            $table->integer('mode');
            $table->string('detail');
            $table->timestamps();
            $table->timestamp("deleted_at")->nullable();

            $table->foreign('company_id')->references('id')->on('companies');

        });
    }
    public function down()
    {
        Schema::dropIfExists('company_payments');
    }
}
