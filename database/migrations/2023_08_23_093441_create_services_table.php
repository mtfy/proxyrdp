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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
			$table->unsignedInteger('user_id')->index('idx_user_id');
			$table->unsignedInteger('pid')->nullable()->default(NULL)->index('idx_product_id');
			$table->unsignedInteger('status')->default(0)->index('idx_status');
			$table->boolean('is_server')->default(false)->index('idx_is_server');
			$table->unsignedDecimal('billing_amount', 10, 2)->default(0.00);
			$table->unsignedTinyInteger('billing_type')->default(0);
			$table->timestampTz('expires_at')->nullable()->default(NULL);
			$table->unsignedDecimal('bandwidth', 10, 3)->default(0.000);
			$table->unsignedDecimal('bandwidth_used', 10, 3)->default(0.000);
			$table->ipAddress('ip_address')->nullable()->default(NULL);
			$table->string('server_hardware', 4096)->nullable()->default(NULL);
			$table->text('data')->nullable()->default(NULL);
			$table->unsignedInteger('served_by')->nullable()->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
