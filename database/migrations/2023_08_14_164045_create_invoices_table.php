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
        Schema::create('invoices', function (Blueprint $table) {
			$table->unsignedBigInteger('id')->unique()->primary('id')->index('idx_id');
			$table->char('invoice_id', 20)->unique()->index('idx_invoice_id');
			$table->unsignedInteger('user_id')->index('idx_user_id');
			$table->unsignedDecimal('amount_fiat', 10, 2)->default(0.00);
			$table->unsignedDecimal('amount_crypto', 27, 8)->default(0.00000000);
			$table->unsignedTinyInteger('service_type');
			$table->unsignedTinyInteger('status')->default(0);
			$table->timestampTz('created_at', 3)->nullable();
			$table->timestampTz('updated_at', 3)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
