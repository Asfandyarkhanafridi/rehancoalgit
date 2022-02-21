<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('party_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('quality_id');
            $table->integer('truck');
            $table->integer('weight');
            $table->integer('rate');
            $table->string('detail')->nullable();
            $table->string('amount')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->timestamp("deleted_at")->nullable();

            $table->foreign('party_id')->references('id')->on('parties');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('quality_id')->references('id')->on('qualities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
