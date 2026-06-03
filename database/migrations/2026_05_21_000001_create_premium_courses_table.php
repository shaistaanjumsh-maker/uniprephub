<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('premium_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->string('topic_name');
            $table->text('description');
            $table->decimal('price', 12, 2)->default(0);
            $table->string('video_url')->nullable();
            $table->string('pdf_file')->nullable();
            $table->enum('status', ['visible', 'hidden'])->default('visible');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('subject_id')->references('id')->on('subjects')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('premium_courses');
    }
};
