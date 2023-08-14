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
			$table->string('first_name', 128)->after('email_verified_at')->nullable()->fullText('idx_first_name');
			$table->string('last_name', 128)->after('first_name')->nullable()->fullText('idx_last_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
		Schema::table('users', function (Blueprint $table) {
			$table->dropColumn('first_name');
			$table->dropColumn('last_name');
		});
    }
};
