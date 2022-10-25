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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
             $table->foreignId('user_id')->onDelete('cascade')->onUpdate('cascade');
              $table->foreignId('user_provide_id')->onDelete('cascade')->onUpdate('cascade');
             $table->foreignId('provider_id')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['جديد' , 'مستعمل'])->default('جديد')->nullable();
             $table->enum('status_order', ['rejected' , 'delivery' , 'wait'])->default('wait')->nullable();
            $table->text('image')->nullable();
            $table->string('provider_name');
            $table->string('service_name')->nullable();
            $table->string('expertise_name');
            $table->integer('pages_number')->nullable();
            $table->longText('description')->nullable();
            $table->integer('price');
            $table->integer('old_price')->nullable();
            $table->date('delivery_date');
            $table->date('publish_date');
            $table->string('university')->nullable();
            $table->year('year')->nullable(); 
            $table->string('user_name');
            $table->string('user_phone');  
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
        Schema::dropIfExists('orders');
    }
};
