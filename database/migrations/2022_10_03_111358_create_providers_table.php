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
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('name_place')->nullable();
            $table->string('location')->nullable();
            $table->string('phone')->unique();
            $table->boolean('show_phone')->default(0);
            $table->boolean('show_whatsapp')->default(0);
            $table->string('password')->nullable();
            $table->enum('type', ['provider', 'user'])->default('provider')->nullable();
            $table->foreignId('country_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('membership_id')->nullable()->constrained('memberships')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_active')->default(True);
            $table->string('lang')->default('ar');
            $table->text('image')->nullable();
            $table->text('address')->nullable();
            $table->text('facebook')->nullable()->unique();
            $table->text('instagram')->nullable()->unique();
            $table->text('whatsapp')->nullable()->unique();
            $table->text('snap_chat')->nullable()->unique();
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
