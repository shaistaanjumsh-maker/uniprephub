<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->string('title');
            $table->string('subject')->nullable();
            $table->text('description')->nullable();
            $table->string('pdf_path');
            $table->string('thumbnail_path')->nullable();
            $table->string('tags')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
