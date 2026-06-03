<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('premium_courses', function (Blueprint $table) {
            if (!Schema::hasColumn('premium_courses', 'features')) {
                $table->json('features')->nullable()->after('thumbnail');
            }
            if (!Schema::hasColumn('premium_courses', 'duration_label')) {
                $table->string('duration_label')->nullable()->after('features');
            }
            if (!Schema::hasColumn('premium_courses', 'syllabus_label')) {
                $table->string('syllabus_label')->nullable()->after('duration_label');
            }
        });
    }

    public function down()
    {
        Schema::table('premium_courses', function (Blueprint $table) {
            if (Schema::hasColumn('premium_courses', 'features')) {
                $table->dropColumn('features');
            }
            if (Schema::hasColumn('premium_courses', 'duration_label')) {
                $table->dropColumn('duration_label');
            }
            if (Schema::hasColumn('premium_courses', 'syllabus_label')) {
                $table->dropColumn('syllabus_label');
            }
        });
    }
};
