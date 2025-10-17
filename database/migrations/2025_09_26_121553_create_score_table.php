<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('score_kpi', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik');
            $table->string('jabatan');
            $table->string('divisi');
            $table->json('answers'); // simpan jawaban pertanyaan dalam format JSON
            $table->integer('total_score'); // nilai total
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('score_kpi');
    }
};

