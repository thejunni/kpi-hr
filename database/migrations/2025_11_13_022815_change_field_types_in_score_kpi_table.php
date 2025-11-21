<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
	public function up(): void
	{
		// Pastikan nilai di kolom performance dan potential valid (hanya angka)
		DB::statement("UPDATE score_kpi SET performance = NULL WHERE performance !~ '^[0-9]+$'");
		DB::statement("UPDATE score_kpi SET potential = NULL WHERE potential !~ '^[0-9]+$'");

		// Ubah tipe kolom menggunakan SQL agar PostgreSQL tidak error
		DB::statement('ALTER TABLE score_kpi ALTER COLUMN performance TYPE INTEGER USING performance::integer');
		DB::statement('ALTER TABLE score_kpi ALTER COLUMN potential TYPE INTEGER USING potential::integer');
		DB::statement('ALTER TABLE score_kpi ALTER COLUMN category TYPE VARCHAR(255)');
		DB::statement('ALTER TABLE score_kpi ALTER COLUMN description TYPE TEXT');
	}

	public function down(): void
	{
		// Kembalikan ke tipe semula (string)
		DB::statement('ALTER TABLE score_kpi ALTER COLUMN performance TYPE VARCHAR(255)');
		DB::statement('ALTER TABLE score_kpi ALTER COLUMN potential TYPE VARCHAR(255)');
		DB::statement('ALTER TABLE score_kpi ALTER COLUMN category TYPE VARCHAR(255)');
		DB::statement('ALTER TABLE score_kpi ALTER COLUMN description TYPE VARCHAR(255)');
	}
};
