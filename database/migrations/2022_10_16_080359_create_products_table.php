<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Expertise;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
           $table->id();
           $table->string('name_ar')->nullable();
           $table->string('name_en')->nullable();
           $table->foreignIdFor(Expertise::class);
           $table->enum('status', ['new' , 'utilizes'])->default('new')->nullable();
           $table->text('image')->nullable();
           $table->integer('pages_number')->nullable();
           $table->longText('description')->nullable();
           $table->integer('price')->nullable();
           $table->date('delivery_date')->nullable();
           $table->string('university')->nullable();
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
        Schema::dropIfExists('products');
    }
};
