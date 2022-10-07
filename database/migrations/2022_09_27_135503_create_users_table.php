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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password')->nullable();
            $table->enum('type', ['super_admin', 'admin', 'student'])->default('student')->nullable();
            $table->boolean('verify_phone')->default(0);
            $table->boolean('verify_email')->default(0);
            $table->foreignId('country_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('membership_id')->nullable()->constrained('memberships')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('code')->nullable();
            $table->boolean('is_active')->default(True);
            $table->text('image')->nullable();
            $table->string('lang')->default('ar');
            $table->integer('age')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->longText('fcm_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
