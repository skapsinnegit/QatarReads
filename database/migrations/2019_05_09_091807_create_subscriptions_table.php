<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('program_id');
            $table->tinyInteger('parent_id');
            $table->string('address');
            $table->string('state');
            $table->string('city');
            $table->string('pincode');
            $table->string('country');
            $table->string('language');
            $table->integer('total');
            $table->text('childrens');
            $table->tinyInteger('monthly_subscription');
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('subscriptions');
    }
}
