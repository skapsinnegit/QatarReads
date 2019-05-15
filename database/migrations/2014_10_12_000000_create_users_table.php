<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('password')->nullable();
            $table->string('type')->nullable();
            $table->string('email');
            $table->string('mobile')->nullable();
            $table->string('institution_name')->nullable();
            $table->tinyInteger('editor_roll')->nullable();
            $table->string('assigned_program')->nullable();
            $table->string('occupation')->nullable();
            $table->boolean('verified')->default(false);
            $table->tinyInteger('roll');
            $table->integer('otp')->nullable();
            $table->softDeletes();
            $table->unsignedTinyInteger('fail_attempt')->default(0);
            $table->tinyInteger('status')->default(1);
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
}
