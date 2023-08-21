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
		Schema::create('payments', function (Blueprint $table) {
			$table->char('token', 20)->primary()->unique()->fullText('idx_token');
			$table->unsignedBigInteger('invoice_id')->unique()->index('idx_invoice_id');
			$table->unsignedBigInteger('payment_id')->unique()->nullable()->default(NULL)->index('idx_payment_id');
			$table->unsignedInteger('user_id')->index('idx_user_id');
			$table->unsignedDecimal('amount', 10, 2)->default(0.00);
			$table->unsignedTinyInteger('status')->default(0);
			$table->ipAddress('ip_address')->nullable()->default(NULL);
			$table->string('currency', 32)->nullable()->default(NULL);
			$table->string('address', 255)->nullable()->default(NULL);
			$table->unsignedDecimal('amount_crypto', 27, 7)->default(0);
			$table->timestampTz('created_at', 3)->nullable();
			$table->timestampTz('updated_at', 3)->nullable();
		});

		Schema::table('users', function (Blueprint $table) {
			$table->unsignedDecimal('balance', 10, 2)->after('remember_token')->default(0.00);
        });
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('invoices');

		Schema::table('users', function (Blueprint $table) {
			$table->dropColumn('balance');
		});
	}
};
