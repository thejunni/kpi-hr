<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::table('score_kpi', function (Blueprint $table) {
			$table->string('bulan', 20)->nullable()->after('total_score');
			$table->smallInteger('tahun')->nullable()->after('bulan');
		});
	}

	public function down(): void
	{
		Schema::table('score_kpi', function (Blueprint $table) {
			$table->dropColumn(['bulan', 'tahun']);
		});
	}
};
