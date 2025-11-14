<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'score_kpi';

    protected $fillable = [
        'name',
        'nik',
        'jabatan',
        'divisi',
        'answers',
        'total_score',
		'bulan',
		'tahun',
		'sp',
		'performance',
		'potential',
		'category',
		'description'
    ];

    protected $casts = [
        'answers' => 'array',
    ];
}
