<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Question;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    // Tampilkan form
    public function showQuestion()
    {
        $questions = [
            [
                'aspek' => 'Hasil KERJA (KPI)',
                'sub_aspek' => 'Kualitas Dan Kuantitas Hasil Kerja',
                'pertanyaan' => 'Kualitas dan kuantitas hasil kerja sesuai standar?',
                'options' => [
					'A' => ['text' => 'Kualitas/Kuantitas selalu diatas standard / target.', 'score' => 100],
					'B' => ['text' => 'Kualitas/Kuantitas pada umumnya melebihi standar/target', 'score' => 90],
					'C' => ['text' => 'Kualitas/Kuantitas mencapai standar/target', 'score' => 80],
					'D' => ['text' => 'Kualitas/Kuantitas dibawah standar/target', 'score' => 70],
					'E' => ['text' => 'Kualitas/Kuantitas jauh dibawah standar/target', 'score' => 60],
                ]
            ],
            [
                'aspek' => 'Sikap Kerja',
                'sub_aspek' => 'Perilaku',
                'pertanyaan' => 'Perilaku',
                'options' => [
					'A' => ['text' => 'Selalu bersikap positif, cepat memahami & melaksanakan tugas dengan baik', 'score' => 5],
					'B' => ['text' => 'Tidak Menyatakan keberatan, serta memahami & melaksanakan tugas dengan sungguh-sungguh', 'score' => 4],
					'C' => ['text' => 'Sesekali melakukan penolakan, yang bersangkutan, memahami & menerima serta melaksanakan kebijakan', 'score' => 3],
					'D' => ['text' => 'Sering menolak, kurang memahami dan melaksanakan kebijakan hanya dengan setengah hati', 'score' => 2],
					'E' => ['text' => 'Hampir selalu menolak, tidak memahamai & melakasanakan kebijakan dengan semaunya', 'score' => 1],
				]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Inisiatif',
                    'pertanyaan' => 'Inisiatif',
                    'options' => [
					'A' => ['text' => 'Inisiatifnya sangat menonjol, mampu untuk melakukan perkerjaan atas prakasrsa sendiri', 'score' => 5],
					'B' => ['text' => 'Berusaha melaksanakan perkerjaan atas prakarsa sendiri, kadang dengan inisiatifnya perlu diarahkan', 'score' => 4],
					'C' => ['text' => 'Biasanya melakukan tugas atas petunjuk yang telah digariskan & mampu untuk menyelesaikan kasus-kasus tertentu', 'score' => 3],
					'D' => ['text' => 'Masih harus mendapatkan dorongan untuk mencapai hasil rata - rata seperti yang diharapkan', 'score' => 2],
					'E' => ['text' => 'Sikap kerjanya pasif & cepat jenuh dengan hasil kurang memuaskan, selalu harus didorong untuk menyelesaikan tugas', 'score' => 1],
                    ]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Disiplin',
                    'pertanyaan' => 'Disiplin',
                    'options' => [
					'A' => ['text' => 'Selalu hadir sebelum waktu mulai kerja, keterlambatannya sangat beralasan & dapat dalam dipercaya penggunaan waktunya.', 'score' => 10],
					'B' => ['text' => 'Hampir tidak pernah terlambat dan mampu menggunakan waktu kerjanya dengan sangat bertanggung jawab.', 'score' => 8],
					'C' => ['text' => 'Cukup menghargai waktu kerja, kadang kadang terlambat dengan cukup beralasan', 'score' => 6],
					'D' => ['text' => 'Seringkali terlambat hadir dan kurnag menghargai waktu kerja, alasan keterlambatan sering kurang meyakinkan', 'score' => 4],
					'E' => ['text' => 'Hampir setiap kali terlambat masuk kerja & mangkir waktu kerja banyak terbuang untuk urusan luar perkerjaannya', 'score' => 2],
                    ]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Kerjasama',
                    'pertanyaan' => 'Kerjasama',
                    'options' => [
					'A' => ['text' => 'Selalu terlibat dalam kerjasama & menjadi dinamisator kelompok kerjanya serta mengutamakan kepentingan kelompoknya.', 'score' => 5],
					'B' => ['text' => 'Hampir selalu menunjukan hubungan kerja yang menyenangkan & giat melibatkan diri demi tercapai tujuan kelompok.', 'score' => 4],
					'C' => ['text' => 'Pada umumnya hubungan dengan rekan sekerja/atasan baik, mau melibatkan diri demi tercapainya tujuan kelompok', 'score' => 3],
					'D' => ['text' => 'kurang melibatkan diri dalam kegiatan kelompok & kadang kadang menempatkan kepentingan pribadi diatas kepentingan kelompok', 'score' => 2],
					'E' => ['text' => 'Sikapnya acuh tak acuh terhadap rekan sekerja & sulit diajak kerja sama serta tidak mau melibatkan diri dalam kegiatan berkelompok', 'score' => 1],
                    ]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Tanggung Jawab',
                    'pertanyaan' => 'Tanggung Jawab',
                    'options' => [
					'A' => ['text' => 'Kemampuannya untuk menyelesaikan tugas berat telah teruji, gigih, dan positif dalam menghadapi tambahan beban kerja.', 'score' => 5],
					'B' => ['text' => 'Bertambahnya beban kerja dapat diterima dengan baik, cara kerjanya sangat efektif sehingga mudah menghadapi rintangan /tekanan.', 'score' => 4],
					'C' => ['text' => 'Masih dapat menyelesaikan tugasnya dengan baik meskipun rintangan atau bertambahnya beban kerja', 'score' => 3],
					'D' => ['text' => 'Biasanya beban kerjanya terganggu bila menghadapi rintangan / tekanan, bersikap negatif dalam menghadapi beban kerja yang berat', 'score' => 2],
					'E' => ['text' => 'Hampir selalu menyerah dan tidak mampu menyelesaikan perkerjaan bila menemu rintangan, bersikap negatif bila ada beban kerja berat.', 'score' => 1],
                    ]
                ],
                [
				'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Penguasaan Perkerjaan',
                    'pertanyaan' => 'Penguasaan Perkerjaan',
                    'options' => [
                        'A' => ['text' => 'Menguasai bidangnya & perenacaan kerjanya hampir sesuai dengan aktual serta hasil kerjanya dapat diandalkan meski tanpa bimbingan.', 'score' => 10],
                        'B' => ['text' => 'Menguasai bidangnya dan sesekali perlu petunjuk atasan, perencanaan kerjanya hampir selalu tepat.', 'score' => 8],
                        'C' => ['text' => 'Cukup menguasai bidang perkerjaannya. Kadang - kadang memerlukan petunjuk atasananya dan perencanaan kerjanya cukup tepat.', 'score' => 6],
                        'D' => ['text' => 'Kurang menguasai bidangnya dan membutuhkan petunjuk atasannya. Banyak rencana kerjanya yang tidak tepat', 'score' => 4],
                        'E' => ['text' => 'Kemampuannya jauh dibawah tuntutan pekerjaan. Selalu membuat kesalahan dan perencanaan kerjanya hampir tidak pernah tepat.', 'score' => 2],
                    ]
			],
        ];

		$employees = Employee::all();
		return view('questions.index', compact('questions', 'employees'));
	}

	// Proses submit form
	public function answer(Request $request)
	{
		$request->validate([
			'employee_id' => 'required|exists:employees,id',
			'answers' => 'required|array',
			'bulan'   => 'required|string',
			'semester' => 'required|integer',
		]);

		$employee = Employee::findOrFail($request->employee_id);
		$questions = $this->getQuestions();

		$totalScore = 0;
		$answersWithScore = [];

		foreach ($request->answers as $qIndex => $choice) {
			$score = $questions[$qIndex]['options'][$choice]['score'] ?? 0;
			$answersWithScore[$qIndex] = [
				'choice' => $choice,
				'text'   => $questions[$qIndex]['options'][$choice]['text'],
				'score'  => $score,
			];
			$totalScore += $score;
		}

		$totalScorePotential = array_sum(array_column(array_slice($answersWithScore, 1), 'score'));

		// SP logic
		$spLevel = $request->input('sp_level', 0);
		$pengurangan = match ($spLevel) {
			1 => 10,
			2 => 20,
			3 => 30,
			default => 0,
		};


		//  Ambil nilai performance & potential
		$performance = $answersWithScore[0]['score'];
		$potential = max(0, $totalScorePotential - $pengurangan);
		//  Tentukan kategori
		if ($performance < 70 && $potential < 16) {
			$category = "No Hopers";
		} elseif ($performance < 80 && $potential < 16) {
			$category = "Foot Soldiers";
		} elseif ($performance <= 100 && $potential < 16) {
			$category = "Workhorses";
		} elseif ($performance < 80 && $potential < 32) {
			$category = "Critical List";
		} elseif ($performance < 90 && $potential < 32) {
			$category = "Cadre";
		} elseif ($performance <= 100 && $potential < 32) {
			$category = "Eagles";
		} elseif ($performance < 80 && $potential <= 40) {
			$category = "Misfits";
		} elseif ($performance < 90 && $potential <= 40) {
			$category = "Prince in waiting";
		} elseif ($performance <= 100 && $potential <= 40) {
			$category = "Stars";
		} else {
			$category = "Error";
		}

		//  Deskripsi otomatis
		$descriptions = [
			'No Hopers' => 'Pull in the plug',
			'Foot Soldiers' => 'Monitoring Needed.',
			'Workhorses' => 'Keeps the show going.',
			'Critical List' => 'Needs salvaging',
			'Cadre' => 'The Typical Employee.',
			'Eagles' => 'Delivers consistently.',
			'Misfits' => 'Attitudinal or job fit issues.',
			'Prince in waiting' => 'More time needed.',
			'Stars' => 'Ready to fly.',
			'Error' => 'Nilai tidak sesuai rentang yang diharapkan.',
		];
		$description = $descriptions[$category];
		$payload = [
			'name'        => $employee->name,
			'nik'         => $employee->nik,
			'jabatan'     => $employee->jabatan,
			'divisi'      => $employee->divisi,
			'answers'     => json_encode($answersWithScore),
			'total_score' => $totalScore,
			'bulan'       => $request->bulan,
			'tahun'       => now()->year,
			'sp' 		  => $spLevel,
			'performance' => $performance,
			'potential'   => $potential,
			'category'	  => $category,
			'description' => $description,
			'semester'	  => (int)$request->semester,
		];
		// Simpan ke DB
		Question::create($payload);

		return redirect()
			->route('questions.result')
			->with('success', "Jawaban berhasil disimpan. Total Nilai (setelah SP): {$totalScore}");
	}


	// Helper untuk pertanyaan (biar tidak duplikat)
	private function getQuestions()
    {
        return [
			[
                'aspek' => 'Hasil KERJA (KPI)',
                'sub_aspek' => 'Kualitas Dan Kuantitas Hasil Kerja',
                'pertanyaan' => 'Kualitas dan kuantitas hasil kerja sesuai standar?',
                'options' => [
					'A' => ['text' => 'Kualitas/Kuantitas selalu diatas standard / target.', 'score' => 100],
					'B' => ['text' => 'Kualitas/Kuantitas pada umumnya melebihi standar/target', 'score' => 90],
					'C' => ['text' => 'Kualitas/Kuantitas mencapai standar/target', 'score' => 80],
					'D' => ['text' => 'Kualitas/Kuantitas dibawah standar/target', 'score' => 70],
					'E' => ['text' => 'Kualitas/Kuantitas jauh dibawah standar/target', 'score' => 60],
                ]
            ],
            [
                'aspek' => 'Sikap Kerja',
                'sub_aspek' => 'Perilaku',
                'pertanyaan' => 'Perilaku',
                'options' => [
					'A' => ['text' => 'Selalu bersikap positif, cepat memahami & melaksanakan tugas dengan baik', 'score' => 5],
					'B' => ['text' => 'Tidak Menyatakan keberatan, serta memahami & melaksanakan tugas dengan sungguh-sungguh', 'score' => 4],
					'C' => ['text' => 'Sesekali melakukan penolakan, yang bersangkutan, memahami & menerima serta melaksanakan kebijakan', 'score' => 3],
					'D' => ['text' => 'Sering menolak, kurang memahami dan melaksanakan kebijakan hanya dengan setengah hati', 'score' => 2],
					'E' => ['text' => 'Hampir selalu menolak, tidak memahamai & melakasanakan kebijakan dengan semaunya', 'score' => 1],
				]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Inisiatif',
                    'pertanyaan' => 'Inisiatif',
                    'options' => [
					'A' => ['text' => 'Inisiatifnya sangat menonjol, mampu untuk melakukan perkerjaan atas prakasrsa sendiri', 'score' => 5],
					'B' => ['text' => 'Berusaha melaksanakan perkerjaan atas prakarsa sendiri, kadang dengan inisiatifnya perlu diarahkan', 'score' => 4],
					'C' => ['text' => 'Biasanya melakukan tugas atas petunjuk yang telah digariskan & mampu untuk menyelesaikan kasus-kasus tertentu', 'score' => 3],
					'D' => ['text' => 'Masih harus mendapatkan dorongan untuk mencapai hasil rata - rata seperti yang diharapkan', 'score' => 2],
					'E' => ['text' => 'Sikap kerjanya pasif & cepat jenuh dengan hasil kurang memuaskan, selalu harus didorong untuk menyelesaikan tugas', 'score' => 1],
                    ]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Disiplin',
                    'pertanyaan' => 'Disiplin',
                    'options' => [
					'A' => ['text' => 'Selalu hadir sebelum waktu mulai kerja, keterlambatannya sangat beralasan & dapat dalam dipercaya penggunaan waktunya.', 'score' => 10],
					'B' => ['text' => 'Hampir tidak pernah terlambat dan mampu menggunakan waktu kerjanya dengan sangat bertanggung jawab.', 'score' => 8],
					'C' => ['text' => 'Cukup menghargai waktu kerja, kadang kadang terlambat dengan cukup beralasan', 'score' => 6],
					'D' => ['text' => 'Seringkali terlambat hadir dan kurnag menghargai waktu kerja, alasan keterlambatan sering kurang meyakinkan', 'score' => 4],
					'E' => ['text' => 'Hampir setiap kali terlambat masuk kerja & mangkir waktu kerja banyak terbuang untuk urusan luar perkerjaannya', 'score' => 2],
                    ]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Kerjasama',
                    'pertanyaan' => 'Kerjasama',
                    'options' => [
					'A' => ['text' => 'Selalu terlibat dalam kerjasama & menjadi dinamisator kelompok kerjanya serta mengutamakan kepentingan kelompoknya.', 'score' => 5],
					'B' => ['text' => 'Hampir selalu menunjukan hubungan kerja yang menyenangkan & giat melibatkan diri demi tercapai tujuan kelompok.', 'score' => 4],
					'C' => ['text' => 'Pada umumnya hubungan dengan rekan sekerja/atasan baik, mau melibatkan diri demi tercapainya tujuan kelompok', 'score' => 3],
					'D' => ['text' => 'kurang melibatkan diri dalam kegiatan kelompok & kadang kadang menempatkan kepentingan pribadi diatas kepentingan kelompok', 'score' => 2],
					'E' => ['text' => 'Sikapnya acuh tak acuh terhadap rekan sekerja & sulit diajak kerja sama serta tidak mau melibatkan diri dalam kegiatan berkelompok', 'score' => 1],
                    ]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Tanggung Jawab',
                    'pertanyaan' => 'Tanggung Jawab',
                    'options' => [
					'A' => ['text' => 'Kemampuannya untuk menyelesaikan tugas berat telah teruji, gigih, dan positif dalam menghadapi tambahan beban kerja.', 'score' => 5],
					'B' => ['text' => 'Bertambahnya beban kerja dapat diterima dengan baik, cara kerjanya sangat efektif sehingga mudah menghadapi rintangan /tekanan.', 'score' => 4],
					'C' => ['text' => 'Masih dapat menyelesaikan tugasnya dengan baik meskipun rintangan atau bertambahnya beban kerja', 'score' => 3],
					'D' => ['text' => 'Biasanya beban kerjanya terganggu bila menghadapi rintangan / tekanan, bersikap negatif dalam menghadapi beban kerja yang berat', 'score' => 2],
					'E' => ['text' => 'Hampir selalu menyerah dan tidak mampu menyelesaikan perkerjaan bila menemu rintangan, bersikap negatif bila ada beban kerja berat.', 'score' => 1],
                    ]
                ],
                [
				'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Penguasaan Perkerjaan',
                    'pertanyaan' => 'Penguasaan Perkerjaan',
                    'options' => [
                        'A' => ['text' => 'Menguasai bidangnya & perenacaan kerjanya hampir sesuai dengan aktual serta hasil kerjanya dapat diandalkan meski tanpa bimbingan.', 'score' => 10],
                        'B' => ['text' => 'Menguasai bidangnya dan sesekali perlu petunjuk atasan, perencanaan kerjanya hampir selalu tepat.', 'score' => 8],
                        'C' => ['text' => 'Cukup menguasai bidang perkerjaannya. Kadang - kadang memerlukan petunjuk atasananya dan perencanaan kerjanya cukup tepat.', 'score' => 6],
                        'D' => ['text' => 'Kurang menguasai bidangnya dan membutuhkan petunjuk atasannya. Banyak rencana kerjanya yang tidak tepat', 'score' => 4],
                        'E' => ['text' => 'Kemampuannya jauh dibawah tuntutan pekerjaan. Selalu membuat kesalahan dan perencanaan kerjanya hampir tidak pernah tepat.', 'score' => 2],
                    ]
			],
        ];
    }

    public function result2(Request $request)
    {
        $divisi = $request->get('divisi');

        $query = Question::query();

        if ($divisi) {
            $query->where('divisi', $divisi);
        }

        $results = $query->orderBy('created_at', 'desc')->get();

        $divisions = Question::select('divisi')->distinct()->pluck('divisi');

        return view('questions.result', compact('results', 'divisi', 'divisions'));
    }

	public function result3(Request $request)
    {
        $divisi = $request->get('divisi');
		$bulan = strtolower($request->get('bulan'));
        $tahunMulai = $request->get('tahun_mulai');
        $tahunAkhir = $request->get('tahun_akhir');

        $query = Question::select(
                'name',
                'nik',
                'jabatan',
                'divisi',
			'bulan',
                DB::raw('AVG(total_score) as avg_score')
            )
			->groupBy('name', 'nik', 'jabatan', 'divisi', 'bulan');

        // filter divisi
        if ($divisi) {
            $query->where('divisi', $divisi);
        }

		// filter bulan
		if ($bulan) {
			$query->where('bulan', $bulan);
		}

		// ambil driver db (mysql / pgsql)
		$driver = DB::getDriverName();

        // filter tahun
        if ($tahunMulai && $tahunAkhir) {
            if ($driver === 'mysql') {
                $query->whereBetween(DB::raw('YEAR(created_at)'), [$tahunMulai, $tahunAkhir]);
            } else { // postgres
                $query->whereBetween(DB::raw("EXTRACT(YEAR FROM created_at)"), [$tahunMulai, $tahunAkhir]);
            }
        } elseif ($tahunMulai) {
            if ($driver === 'mysql') {
                $query->whereYear('created_at', $tahunMulai);
            } else {
                $query->whereRaw("EXTRACT(YEAR FROM created_at) = ?", [$tahunMulai]);
            }
        }

        $results = $query->get();

        $divisions = Question::select('divisi')->distinct()->pluck('divisi');
		$bulans = Question::select('bulan')->distinct()->pluck('bulan');

		return view('questions.result', compact('results', 'divisions', 'bulans'));
    }
	public function result4(Request $request)
	{
		$divisi = $request->get('divisi');
		$bulan = strtolower($request->get('bulan'));
		$tahunMulai = $request->get('tahun_mulai');
		$tahunAkhir = $request->get('tahun_akhir');

		$query = Question::select(
			'id',
			'name',
			'nik',
			'jabatan',
			'divisi',
			'bulan',
			'answers',
			'total_score',
			'performance',
			'potential',
			'category',
			'description',
			'tahun'
		);

		if ($divisi) {
			$query->where('divisi', $divisi);
		}

		if ($bulan) {
			$query->where('bulan', $bulan);
		}

		$driver = DB::getDriverName();

		if ($tahunMulai && $tahunAkhir) {
			if ($driver === 'mysql') {
				$query->whereBetween('tahun', [$tahunMulai, $tahunAkhir]);
				// $query->whereBetween(DB::raw('YEAR(created_at)'), [$tahunMulai, $tahunAkhir]);
			} else {
				$query->whereBetween('tahun', [$tahunMulai, $tahunAkhir]);
				// $query->whereBetween(DB::raw("EXTRACT(YEAR FROM created_at)"), [$tahunMulai, $tahunAkhir]);
			}
		} elseif ($tahunMulai) {
			if ($driver === 'mysql') {
				$query->where('tahun', $tahunMulai);
			} else {
				$query->whereRaw("EXTRACT(YEAR FROM created_at) = ?", [$tahunMulai]);
			}
		}

		$records = $query->get();

		// Proses hasil JSON dan kelompokkan
		$results = $records->map(function ($item) {
			$answers = is_string($item->answers)
				? json_decode($item->answers, true)
				: $item->answers;

			if (!$answers) {
				return null;
			}
			$total = collect($answers)->sum('score');
			return [
				'id' => $item->id,
				'name' => $item->name,
				'nik' => $item->nik,
				'jabatan' => $item->jabatan,
				'divisi' => $item->divisi,
				'bulan' => $item->bulan,
				'kualitas_dan_kuantitas' => $item->performance,
				'sikap_kerja' => $item->potential,
				'total_nilai' => $total,
				'category' => $item->category,
				'description' => $item->description,
			];
		})->filter();

		$categoryCounts = $results->groupBy('category')->map->count();
		$allCategories = [
			'Stars',
			'Prince of Waiting',
			'Critical Hit',
			'Cadre',
			'Eagles',
			'Workhorse',
			'Foot Soldiers',
			'No Hopers',
			'Misfit',
		];

		$categoryCountsFinal = [];

		foreach ($allCategories as $cat) {
			$categoryCountsFinal[$cat] = $categoryCounts[$cat] ?? 0;
		}
		dd($categoryCountsFinal);

		$divisions = Question::select('divisi')->distinct()->pluck('divisi');
		$bulans = Question::select('bulan')->distinct()->pluck('bulan');

		return view('questions.result', compact('results', 'divisions', 'bulans', 'categoryCountsFinal'));
	}
	public function result(Request $request)
	{
		// Ambil filter dari request
		$divisi = $request->get('divisi');
		$bulan = strtolower($request->get('bulan'));
		$tahunMulai = $request->get('tahun_mulai');
		$tahunAkhir = $request->get('tahun_akhir');

		$queryTable = Question::select(
			'id',
			'name',
			'nik',
			'jabatan',
			'divisi',
			'bulan',
			'answers',
			'total_score',
			'performance',
			'potential',
			'category',
			'description',
			'tahun',
			'semester'
		);

		// Filter divisi (opsional)
		if ($divisi) {
			$queryTable->where('divisi', $divisi);
		}

		// Filter bulan (opsional)
		if ($bulan) {
			$queryTable->where('bulan', $bulan);
		}

		// Filter tahun (wajib)
		if ($tahunMulai && $tahunAkhir) {
			$queryTable->whereBetween('tahun', [$tahunMulai, $tahunAkhir]);
		} elseif ($tahunMulai) {
			$queryTable->where('tahun', $tahunMulai);
		}

		$recordsTable = $queryTable->get();

		// Olah JSON table → jadi array rapi
		$resultsTable = $recordsTable->map(function ($item) {
			$answers = is_string($item->answers)
				? json_decode($item->answers, true)
				: $item->answers;

			if (!$answers) {
				return null;
			}

			$total = collect($answers)->sum('score');

			return [
				'id' => $item->id,
				'name' => $item->name,
				'nik' => $item->nik,
				'jabatan' => $item->jabatan,
				'divisi' => $item->divisi,
				'bulan' => $item->bulan,
				'kualitas_dan_kuantitas' => $item->performance,
				'sikap_kerja' => $item->potential,
				'total_nilai' => $total,
				'category' => $item->category,
				'description' => $item->description,
				'semester' => $item->semester
			];
		})->filter();

		$queryMatrix = Question::select(
			'id',
			'name',
			'nik',
			'jabatan',
			'divisi',
			'bulan',
			'answers',
			'total_score',
			'performance',
			'potential',
			'category',
			'description',
			'tahun'
		);

		// Filter tahun
		if ($tahunMulai && $tahunAkhir) {
			$queryMatrix->whereBetween('tahun', [$tahunMulai, $tahunAkhir]);
		} elseif ($tahunMulai) {
			$queryMatrix->where('tahun', $tahunMulai);
		}

		// Divisi opsional
		if ($divisi) {
			$queryMatrix->where('divisi', $divisi);
		}

		$recordsMatrix = $queryMatrix->get();

		// Olah JSON matrix
		$resultsMatrix = $recordsMatrix->map(function ($item) {
			$answers = is_string($item->answers)
				? json_decode($item->answers, true)
				: $item->answers;

			if (!$answers) {
				return null;
			}

			$total = collect($answers)->sum('score');

			return [
				'id' => $item->id,
				'name' => $item->name,
				'nik' => $item->nik,
				'jabatan' => $item->jabatan,
				'divisi' => $item->divisi,
				'kualitas_dan_kuantitas' => $item->performance,
				'sikap_kerja' => $item->potential,
				'total_nilai' => $total,
				'category' => $item->category,
				'description' => $item->description,
			];
		})->filter();

		$categoryCounts = $resultsMatrix->groupBy('category')->map->count();

		$allCategories = [
			'Stars',
			'Prince of Waiting',
			'Critical Hit',
			'Cadre',
			'Eagles',
			'Workhorse',
			'Foot Soldiers',
			'No Hopers',
			'Misfit',
		];

		$categoryCountsFinal = [];
		foreach ($allCategories as $cat) {
			$categoryCountsFinal[$cat] = $categoryCounts[$cat] ?? 0;
		}

		$divisions = Question::select('divisi')->distinct()->pluck('divisi');
		$bulans = Question::select('bulan')->distinct()->pluck('bulan');

		return view('questions.result', [
			'results' => $resultsTable,             // untuk table
			'categoryCountsFinal' => $categoryCountsFinal, // untuk matrix
			'divisions' => $divisions,
			'bulans' => $bulans,
		]);
	}


	public function downloadPdf(Request $request)
	{
	    Carbon::setLocale('id');

	    $divisi     = $request->get('divisi');
	    $tahunMulai = $request->get('tahun_mulai');
	    $tahunAkhir = $request->get('tahun_akhir');

	    $query = DB::table('score_kpi')
	        ->select(
	            'name',
	            'nik',
	            'jabatan',
	            'divisi',
	            DB::raw('AVG(total_score) as avg_score')
	        )
	        ->groupBy('name', 'nik', 'jabatan', 'divisi');

	    // filter divisi
	    if (!empty($divisi)) {
	        $query->where('divisi', $divisi);
	    }

	    $driver = DB::getDriverName();

	    // filter tahun
	    if ($tahunMulai && $tahunAkhir) {
	        if ($driver === 'mysql') {
	            $query->whereBetween(DB::raw('YEAR(created_at)'), [$tahunMulai, $tahunAkhir]);
	        } else {
	            $query->whereBetween(DB::raw("EXTRACT(YEAR FROM created_at)"), [$tahunMulai, $tahunAkhir]);
	        }
	    } elseif ($tahunMulai) {
	        if ($driver === 'mysql') {
	            $query->whereYear('created_at', $tahunMulai);
	        } else {
	            $query->whereRaw("EXTRACT(YEAR FROM created_at) = ?", [$tahunMulai]);
	        }
	    }

	    $results = $query->orderBy('divisi')->get();

	    // Tambahkan kategori berdasarkan skor
	    foreach ($results as $item) {
	        $score = $item->avg_score;
	        if ($score >= 90) {
	            $item->kategori = 'A';
	        } elseif ($score >= 80) {
	            $item->kategori = 'B';
	        } elseif ($score >= 70) {
	            $item->kategori = 'C';
	        } elseif ($score >= 60) {
	            $item->kategori = 'D';
	        } else {
	            $item->kategori = 'E';
	        }
	    }

	    // Kirim ke view PDF
	    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('questions.result-pdf', [
	        'results'    => $results,
	        'divisi'     => $divisi,
	        'tahunMulai' => $tahunMulai,
			'tahunAkhir' => $tahunAkhir,
	        'tanggalCetak' => Carbon::now()->translatedFormat('d F Y')
	    ]);

	    // Gunakan nama file dengan tanggal berformat Indonesia
	    $fileName = "Laporan Pencapaian KPI - {$divisi} - {$tahunMulai}-{$tahunAkhir} (" . Carbon::now()->translatedFormat('d F Y') . ").pdf";

	    return $pdf->download($fileName);
	}

	public function destroy($id)
	{
		try {
			$question = Question::findOrFail($id);

			if (!$question) {
				return redirect()->back()->with('error', 'Data tidak ditemukan.');
			}
			$question->delete();

			return redirect()
				->route('questions.result')
				->with('success', 'Data berhasil dihapus.');
		} catch (\Exception $e) {
			return redirect()
				->route('questions.result')
				->with('error', 'Gagal menghapus data: ' . $e->getMessage());
		}
	}
	public function category($slug)
	{
		$categories = [
			'star' => 'Star',
			'prince-in-waiting' => 'Prince in Waiting',
			'eagles' => 'Eagles',
			'cadre' => 'Cadre',
			'misfit' => 'Misfit',
			'workhorse' => 'Workhorse',
			'kritikal-hit' => 'Kritikal Hit',
			'foot-soldiers' => 'Foot Soldiers',
			'no-hopers' => 'No Hopers',
		];

		$title = $categories[$slug] ?? 'Kategori Tidak Dikenal';
		return view('questions.category', compact('title', 'slug'));
	}
	public function matrixShow(Request $request, $type)
	{
		$division = $request->query('division');
		$year = $request->query('year');
		$semester = $request->query('semester'); // ← TAMBAHAN

		$query = Question::query();

		// Filter divisi, tahun, semester
		if (!empty($division)) {
			$query->where('divisi', $division);
		}

		if (!empty($year)) {
			$query->where('tahun', $year);
		}

		if (!empty($semester)) {
			$query->where('semester', (int) $semester);
		}

		// Tentukan kategori matrix
		switch ($type) {
			case 'stars':
				$matrixTitle = 'Stars';
				$query->where('category', 'Stars');
				$color = '#c6df6e';
				break;

			case 'prince-of-waiting':
				$matrixTitle = 'Prince in Waiting';
				$query->where('category', 'Prince in Waiting');
				$color = '#a6ce6e';
				break;

			case 'misfit':
				$matrixTitle = 'Misfits';
				$query->where('category', 'Misfits');
				$color = '#f5c400';
				break;

			case 'critical-hit':
				$matrixTitle = 'Critical List';
				$query->where('category', 'Critical List');
				$color = '#e64000';
				break;

			case 'no-hopers':
				$matrixTitle = 'No Hopers';
				$query->where('category', 'No Hopers');
				$color = '#600000';
				break;

			case 'cadre':
				$matrixTitle = 'Cadre';
				$query->where('category', 'Cadre');
				$color = '#ffe100';
				break;

			case 'eagles':
				$matrixTitle = 'Eagles';
				$query->where('category', 'Eagles');
				$color = '#3e833e';
				break;

			case 'workhorse':
				$matrixTitle = 'Workhorse';
				$query->where('category', 'Workhorse');
				$color = '#f59200';
				break;

			case 'foot-soldiers':
				$matrixTitle = 'Foot Soldiers';
				$query->where('category', 'Foot Soldiers');
				$color = '#7d0000';
				break;

			default:
				$matrixTitle = 'Matrix Result';
				$color = '#999';
				break;
		}

		// Ambil hasil
		$questions = $query->orderByDesc('total_score')->get();

		return view('matrix.show', compact(
			'questions',
			'type',
			'matrixTitle',
			'color',
			'division',
			'year',
			'semester'
		));
	}

	public function getCategoryName($performance, $potential)
	{
		if ($performance < 70 && $potential < 16) return 'No Hopers';
		if ($performance < 80 && $potential < 16) return 'Foot Soldiers';
		if ($performance <= 100 && $potential < 16) return 'Workhorses';
		if ($performance < 80 && $potential < 32) return 'Critical Hit';
		if ($performance < 90 && $potential < 32) return 'Cadre';
		if ($performance <= 100 && $potential < 32) return 'Eagles';
		if ($performance < 80 && $potential <= 40) return 'Misfit';
		if ($performance < 90 && $potential <= 40) return 'Prince of Waiting';
		if ($performance <= 100 && $potential <= 40) return 'Stars';

		return 'Error';
	}

	public function matrixCount(Request $request)
	{
		$year = $request->get('year');
		$division = $request->get('division');
		$semester = $request->get('semester'); // ← TAMBAHAN

		$query = Question::where('tahun', $year);

		if ($division) {
			$query->where('divisi', $division);
		}

		// filter semester bila dipilih
		if ($semester) {
			$query->where('semester', (int) $semester);
		}

		$records = $query->get();

		$results = $records->map(function ($item) {
			$answers = json_decode($item->answers, true);
			if (!$answers) return null;

			return [
				'category' => $item->category
			];
		})->filter();

		$categoryCounts = $results->groupBy('category')->map->count();

		$allCategories = [
			'Stars',
			'Prince of Waiting',
			'Critical Hit',
			'Cadre',
			'Eagles',
			'Workhorse',
			'Foot Soldiers',
			'No Hopers',
			'Misfit'
		];

		$final = [];
		foreach ($allCategories as $cat) {
			$final[$cat] = $categoryCounts[$cat] ?? 0;
		}

		return response()->json($final);
	}

	public function downloadMatrix(Request $req)
	{
		$matrixTitle   		= $req->type;
		$year    		    = $req->year;
		$division    		= $req->division;
		$semester           = $req->semester;
		// Sesuaikan warna + nama resmi + filter kategori
		switch ($matrixTitle) {
			case 'Stars':
				$matrixTitle = 'Stars';
				$categoryFilter = 'Stars';
				$color = '#c6df6e';
				break;

			case 'Prince of Waiting':
				$matrixTitle = 'Prince in Waiting';
				$categoryFilter = 'Prince in Waiting';
				$color = '#a6ce6e';
				break;

			case 'Misfit':
				$matrixTitle = 'Misfits';
				$categoryFilter = 'Misfits';
				$color = '#f5c400';
				break;

			case 'Critical Hit':
				$matrixTitle = 'Critical List';
				$categoryFilter = 'Critical List';
				$color = '#e64000';
				break;

			case 'No Hopers':
				$matrixTitle = 'No Hopers';
				$categoryFilter = 'No Hopers';
				$color = '#600000';
				break;

			case 'Cadre':
				$matrixTitle = 'Cadre';
				$categoryFilter = 'Cadre';
				$color = '#ffe100';
				break;

			case 'Eagles':
				$matrixTitle = 'Eagles';
				$categoryFilter = 'Eagles';
				$color = '#3e833e';
				break;

			case 'Workhorse':
				$matrixTitle = 'Workhorse';
				$categoryFilter = 'Workhorse';
				$color = '#f59200';
				break;

			case 'Foot Soldiers':
				$matrixTitle = 'Foot Soldiers';
				$categoryFilter = 'Foot Soldiers';
				$color = '#7d0000';
				break;
		}

		// Query data sesuai filter
		$questions = Question::when($year, fn($q) => $q->where('tahun', $year))
			->when($division, fn($q) => $q->where('divisi', $division))
			->when($semester, fn($q) => $q->where('semester', $semester))
			->when($categoryFilter, fn($q) => $q->where('category', $categoryFilter))
			->get();

		// Generate PDF
		$pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
			'matrix.download-pdf',
			compact('questions', 'matrixTitle', 'year', 'division', 'color')
		)->setPaper('A4', 'landscape');

		return $pdf->download("Matrix-{$matrixTitle}-{$year}.pdf");
	}
}
