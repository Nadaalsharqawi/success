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
        Schema::create('membership_discounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedFloat('discount')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->foreignId('membership_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('limit_for_user')->nullable();
            $table->enum('type' , ['fixed' , 'percentage'])->nullable();
            $table->unsignedFloat('max_discount')->nullable();
            $table->unsignedInteger('limit_use')->nullable();
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
        Schema::dropIfExists('membership_discounts');
    }
};
