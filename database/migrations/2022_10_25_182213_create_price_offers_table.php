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
        Schema::create('price_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_offer_id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_offer_id')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('price_offer')->nullable();
            $table->enum('status_offer', ['rejected' , 'accept' , 'wait'])->default('wait')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('price_offers');
    }
};
