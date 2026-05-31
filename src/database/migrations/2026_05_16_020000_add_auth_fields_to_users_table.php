<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('delegate')->after('email'); // delegate, manager, pro_santé
            $table->integer('failed_login_attempts')->default(0)->after('role');
            $table->timestamp('locked_until')->nullable()->after('failed_login_attempts');
            $table->string('phone')->nullable()->after('locked_until');
            $table->boolean('is_active')->default(true)->after('phone');
            $table->index(['role', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role', 'is_active']);
            $table->dropColumn(['role', 'failed_login_attempts', 'locked_until', 'phone', 'is_active']);
        });
    }
};
