<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('number'); // unsignedTinyInteger - um inteiro pequeno e positivo
            $table->foreignId('series_id')->constrained()->onDelete('cascade'); // faz o mesmo que as linhas comentadas abaixo
            // $table->unsignedBigInteger('series_id'); é o mesmo que $table->foreignId('series_id')
            // $table->foreign('series_id')->references('id')->on('series'); é o mesmo que ->constrained()
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
        Schema::dropIfExists('seasons');
    }
};
