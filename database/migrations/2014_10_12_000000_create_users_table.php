<?php

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username',20)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fullName', 30)->nullable();
            $table->string('profileImage')->nullable();
            $table->string('city', 20)->nullable();
            $table->string('address', 25)->nullable();
            $table->string('country', 20)->default('Algeria');
            $table->decimal('totalRevenue', 8, 3)->default(0);
            $table->unsignedInteger('custumersNumber')->default(0);
            $table->integer('phone')->unsigned()->nullable();;
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }

};
