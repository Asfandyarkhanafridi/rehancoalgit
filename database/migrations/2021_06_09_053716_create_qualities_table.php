<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualitiesTable extends Migration
{
    public function up()
    {
        Schema::create('qualities', function (Blueprint $table) {
            $table->id();
            $table->string("quality");
            $table->string("description")->nullable();
            $table->timestamps();
            $table->timestamp("deleted_at")->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('qualities');
    }
}
