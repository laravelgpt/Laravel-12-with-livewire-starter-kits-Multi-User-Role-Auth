<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->nullable()->after('email');
            $table->string('sms_otp_code')->nullable()->after('otp_code');
            $table->timestamp('sms_otp_expires_at')->nullable()->after('otp_expires_at');
            $table->boolean('sms_otp_verified')->default(false)->after('otp_verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone_number', 'sms_otp_code', 'sms_otp_expires_at', 'sms_otp_verified']);
        });
    }
}; 