<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerPoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_points', function (Blueprint $table) {
            $table->integer('customer_id');
            $table->integer('point');
            $table->timestamps();

            $table->primary('customer_id');
            $table->foreign('customer_id')
                ->references('id')->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_points');
    }
}
