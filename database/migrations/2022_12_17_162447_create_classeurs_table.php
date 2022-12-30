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
        Schema::create('classeurs', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->softDeletes();
            $table->timestamps();
            $table->string('number_classeur');
            $table->string('title_classeur');
            $table->foreignId('created_by');
            $table->foreignId('id_niveau');
            $table->foreign('id_niveau')->references('id')->on('niveaux')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classeurs');
    }
};
