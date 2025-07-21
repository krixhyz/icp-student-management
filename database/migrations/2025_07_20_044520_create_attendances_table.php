<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->date('date');
            $table->boolean('present')->default(false);
            $table->timestamps();
            $table->unique(['student_id', 'date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
