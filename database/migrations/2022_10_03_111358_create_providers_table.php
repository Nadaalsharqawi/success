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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name_place');
            $table->string('location');
            $table->string('phone')->unique();
            $table->boolean('show_phone')->default(0);
            $table->string('whatsapp')->unique();
            $table->boolean('show_whatsapp')->default(0);
            $table->string('password')->nullable();
            $table->foreignId('membership_id')->nullable()->constrained('memberships')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_active')->default(True);
            $table->string('lang')->default('ar');
            $table->text('image')->nullable();
            $table->longText('fac')->nullable();
            $table->longText('ins')->nullable();
            $table->longText('snap')->nullable();
            $table->boolean('admin_approve')->default(0);
            $table->longText('fcm_token')->nullable();
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
        Schema::dropIfExists('providers');
    }
};
