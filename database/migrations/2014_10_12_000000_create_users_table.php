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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('telephone');
            $table->string('email');
            $table->enum('status', ['Actif','Inactif'])->default('Actif');
            $table->string('avatar')->default('default.jpg');
            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();

            $table->enum('type', ['Permanent', 'Temporaire'])->default('Permanent');
            $table->dateTime('limit_start')->nullable();
            $table->dateTime('limit_end')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
