<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('subscriptionId')->unsigned('subscriptions')->nullable()->default(0);
            $table->integer('userId')->unsigned('users')->nullable()->default(0);
            $table->string('planId', 100)->nullable();
            $table->string('customerId', 100)->nullable();
            $table->string('chargeBeeSubscriptionId', 100)->nullable();
            $table->longText('json')->nullable();
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
        Schema::dropIfExists('subscription_purchases');
    }
}
