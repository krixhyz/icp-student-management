<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->enum('role', ['teacher', 'student'])->default('student');
    $table->timestamp('email_verified_at')->nullable(); // Already present
    $table->string('token')->nullable(); // New nullable token field
    $table->rememberToken(); // This adds a nullable "remember_token" column
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}