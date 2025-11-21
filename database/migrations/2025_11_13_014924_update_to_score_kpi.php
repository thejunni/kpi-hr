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
		Schema::table('score_kpi', function (Blueprint $table) {
			$table->string('performance')->nullable();
			$table->string('potential')->nullable();
			$table->string('category')->nullable();
			$table->string('description')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('score_kpi', function (Blueprint $table) {
			$table->dropColumn('performance', 'potential', 'category', 'description');
		});
	}
};
