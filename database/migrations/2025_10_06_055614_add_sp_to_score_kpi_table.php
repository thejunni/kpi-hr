<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom SP ke tabel score_kpi
     */
    public function up(): void
    {
        Schema::table('score_kpi', function (Blueprint $table) {
            // Kolom SP (bisa null, misalnya SP1 / SP2 / SP3)
            $table->string('sp')->nullable()->after('total_score')->comment('Status Surat Peringatan, contoh: SP1, SP2, SP3');
        });
    }

    /**
     * Rollback perubahan
     */
    public function down(): void
    {
        Schema::table('score_kpi', function (Blueprint $table) {
            $table->dropColumn('sp');
        });
    }
};
