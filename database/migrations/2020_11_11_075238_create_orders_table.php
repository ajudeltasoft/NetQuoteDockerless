<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('customer');
            $table->string('company');
            $table->string('funds');
            $table->string('po');
            $table->string('orderType');
            $table->string('jobName');            
            $table->decimal('extraCharge', 8, 2);
            $table->string('notes');
            $table->string('selectAddress');
            $table->string('shippingStreet');
            $table->string('shippingCity');
            $table->string('shippingState');
            $table->string('shippingCountry');            
            $table->integer('shippingZipcode');
            $table->bigInteger('shippingPhone');
            $table->string('via');
            $table->boolean('checkboxAddress');
            $table->string('name');
            $table->string('finalStreet');
            $table->string('finalCity');
            $table->string('finalState');
            $table->string('finalCountry');
            $table->integer('finalZipcode');
            $table->bigInteger('finalPhone');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
