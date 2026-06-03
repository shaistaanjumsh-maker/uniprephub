<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('premium_enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->timestamp('enrolled_at')->useCurrent();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('course_id')->references('id')->on('premium_courses')->cascadeOnDelete();
            $table->unique(['user_id', 'course_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('premium_enrollments');
    }
};
