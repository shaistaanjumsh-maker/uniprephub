<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        $notes = DB::table('notes')->whereNull('slug')->orWhere('slug', '')->get();

        foreach ($notes as $note) {
            $slug = preg_replace('/[^a-z0-9\s-]/', '', strtolower($note->title));
            $slug = trim($slug);
            $slug = preg_replace('/\s+/', '-', $slug);
            $slug = preg_replace('/-+/', '-', $slug);
            $baseSlug = $slug ?: 'note';
            $uniqueSlug = $baseSlug;
            $counter = 2;

            while (DB::table('notes')->where('slug', $uniqueSlug)->exists()) {
                $uniqueSlug = $baseSlug . '-' . $counter;
                $counter++;
            }

            DB::table('notes')->where('id', $note->id)->update(['slug' => $uniqueSlug]);
        }

        Schema::table('notes', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
