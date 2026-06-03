<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'payment_upi_id')) {
                $table->string('payment_upi_id')->nullable()->after('whatsapp_support_number');
            }
            if (!Schema::hasColumn('settings', 'payment_whatsapp')) {
                $table->string('payment_whatsapp')->nullable()->after('payment_upi_id');
            }
            if (!Schema::hasColumn('settings', 'payment_qr_code_id')) {
                $table->unsignedBigInteger('payment_qr_code_id')->nullable()->after('payment_whatsapp');
            }
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (Schema::hasColumn('settings', 'payment_upi_id')) {
                $table->dropColumn('payment_upi_id');
            }
            if (Schema::hasColumn('settings', 'payment_whatsapp')) {
                $table->dropColumn('payment_whatsapp');
            }
            if (Schema::hasColumn('settings', 'payment_qr_code_id')) {
                $table->dropColumn('payment_qr_code_id');
            }
        });
    }
};
