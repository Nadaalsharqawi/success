<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Expertise;
use App\Models\Provider;

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
       $table->foreignId('service_id')->nullable()->onDelete('cascade')->onUpdate('cascade');
       $table->foreignId('expertise_id')->nullable()->onDelete('cascade')->onUpdate('cascade');
       $table->foreignId('provider_id')->nullable()->onDelete('cascade')->onUpdate('cascade');
       $table->enum('status', ['جديد' , 'مستعمل'])->default('جديد')->nullable();
       $table->text('image')->nullable();
       $table->string('provider_name')->nullable();
       $table->string('service_name')->nullable();
       $table->string('expertise_name')->nullable();
       $table->integer('pages_number')->nullable();
       $table->longText('description')->nullable();
       $table->integer('price')->nullable();
       $table->integer('old_price')->nullable();
       $table->date('delivery_date')->nullable();
       $table->date('publish_date')->nullable();
       $table->string('university')->nullable();
       $table->year('year')->nullable();   
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
