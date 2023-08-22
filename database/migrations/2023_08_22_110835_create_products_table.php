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
        Schema::create('products', function (Blueprint $table) {
			$table->id();
				$table->string('title', 64);
				$table->text('description');
				$table->unsignedTinyInteger('category')->default(0);
				$table->unsignedDecimal('price', 10, 2)->default(1.00);
				$table->unsignedTinyInteger('billing')->default(0);
				$table->boolean('disabled')->default(false);
				$table->unsignedInteger('created_by')->index('idx_created_by');
				$table->unsignedInteger('updated_by')->index('idx_updated_by');
			$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
