<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
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
                    'A' => ['text' => 'Kualitas/Kuantitas selalu diatas standar/target', 'score' => 60],
                    'B' => ['text' => 'Kualitas/Kuantitas umumnya melebihi standar/target', 'score' => 48],
                    'C' => ['text' => 'Kualitas/Kuantitas mencapai standar/target', 'score' => 36],
                    'D' => ['text' => 'Kualitas/Kuantitas dibawah standar/target', 'score' => 24],
                    'E' => ['text' => 'Kualitas/Kuantitas jauh dibawah standar/target', 'score' => 12],
                ]
            ],
            [
                'aspek' => 'Sikap Kerja',
                'sub_aspek' => 'Perilaku',
                'pertanyaan' => 'Perilaku',
                'options' => [
                    'A' => ['text' => 'Selalu bersikap positif, cepat memahami & melaksanakan tugas dengan baik', 'score' => 4],
                    'B' => ['text' => 'Tidak Menyatakan keberatan, serta memahami & melaksanakan tugas dengan sungguh-sungguh', 'score' => 3],
                    'C' => ['text' => 'Sesekali melakukan penolakan, yang bersangkutan, memahami & menerima serta melaksanakan kebijakan', 'score' => 2],
                    'D' => ['text' => 'Sering menolak, kurang memahami dan melaksanakan kebijakan hanya dengan setengah hati', 'score' => 1],
                    'E' => ['text' => 'Hampir selalu menolak, tidak memahamai & melakasanakan kebijakan dengan semaunya', 'score' => 0],
                ]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Inisiatif',
                    'pertanyaan' => 'Inisiatif',
                    'options' => [
                        'A' => ['text' => 'Inisiatifnya sangat menonjol, mampu untuk melakukan perkerjaan atas prakasrsa sendiri', 'score' => 4],
                        'B' => ['text' => 'Berusaha melaksanakan perkerjaan atas prakarsa sendiri, kadang dengan inisiatifnya perlu diarahkan', 'score' => 3],
                        'C' => ['text' => 'Biasanya melakukan tugas ats petunjuk yang telah digariskan & mampu untuk menyelesaikan kasus-kasus tertentu', 'score' => 2],
                        'D' => ['text' => 'Masih harus mendapatkan dorongan untuk mencapai hasil rata - rata seperti yang diharapkan', 'score' => 1],
                        'E' => ['text' => 'Sikap kerjanya pasif & cepat jenuh dengan hasil kurang memuaskan, selalu harus didorong untuk menyelesaikan tugas', 'score' => 0],
                    ]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Disiplin',
                    'pertanyaan' => 'Disiplin',
                    'options' => [
                        'A' => ['text' => 'Selalu hadir sebelum waktu mulai kerja, keterlambatannya sangat beralasan & dapat dalam dipercaya penggunaan waktunya.', 'score' => 4],
                        'B' => ['text' => 'Hampir tidak pernah terlambat dan mampu menggunakan waktu kerjanya dengan sangat bertanggung jawab.', 'score' => 3],
                        'C' => ['text' => 'Cukup menghargai waktu kerja, kadang kadang terlambat dengan cukup beralasan', 'score' => 2],
                        'D' => ['text' => 'Seringkali terlambat hadir dan kurnag menghargai waktu kerja, alasan keterlambatan sering kurang meyakinkan', 'score' => 1],
                        'E' => ['text' => 'Hampir setiap kali terlambat masuk kerja & mangkir waktu kerja banyak terbuang untuk urusan luar perkerjaannya', 'score' => 0],
                    ]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Kerjasama',
                    'pertanyaan' => 'Kerjasama',
                    'options' => [
                        'A' => ['text' => 'Selalu terlibat dalam kerjasama & menjadi dinamisator kelompok kerjanya serta mengutamakan kepentingan kelompoknya.', 'score' => 4],
                        'B' => ['text' => 'Hampir selalu menunjukan hubungan kerja yang menyenangkan & giat melibatkan diri demi tercapai tujuan kelompok.', 'score' => 3],
                        'C' => ['text' => 'Pada umumnya hubungan dengan rekan sekerja/atasan baik, mau melibatkan diri demi tercapainya tujuan kelompok', 'score' => 2],
                        'D' => ['text' => 'kurang melibatkan diri dalam kegiatan kelompok & kadnag kadang menempatkan kepentingan pribadi diatas kepentingan kelompok', 'score' => 1],
                        'E' => ['text' => 'Sikapnya acuh tak acuh terhadap rekan sekerja & sulit diajak kerja sama serta tidak mau melibatkan diri dalam kegiatan berkelompok', 'score' => 0],
                    ]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Tanggung Jawab',
                    'pertanyaan' => 'Tanggung Jawab',
                    'options' => [
                        'A' => ['text' => 'Kemampuannya untuk menyelesaikan tugas berat telah teruji, gigih, dan positif dalam menghadapi tambahan beban kerja.', 'score' => 4],
                        'B' => ['text' => 'Bertambahnya beban kerja dapat diterima dengan baik, cara kerjanya sangat efektif sehingga mudah menghadapi rintangan /tekanan.', 'score' => 3],
                        'C' => ['text' => 'Masih dapat menyelesaikan tugasnya dengan baik meskipun rintangan atau bertambahnya beban kerja', 'score' => 2],
                        'D' => ['text' => 'Biasanya beban kerjanya terganggu bila menghadapi rintangan / tekanan, bersikap negatif dalam menghadapi beban kerja yang berat', 'score' => 1],
                        'E' => ['text' => 'Hampir selalu menyerah dan tidak mampu menyelesaikan perkerjaan bila menemu rintangan, bersikap negatif bila ada beban kerja berat.', 'score' => 0],
                    ]
                ],
                [
                    'aspek' => 'Kemampuan Kerja',
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
                [
                    'aspek' => 'Kemampuan Kerja',
                    'sub_aspek' => 'Proses PDCA',
                    'pertanyaan' => 'Proses PDCA',
                    'options' => [
                        'A' => ['text' => 'Selalu memutar roda PDCA secara konsisten pada tiap permasalahan / perkerjaan yang dihadapi sehari - hari.', 'score' => 10],
                        'B' => ['text' => 'Selalu berusaha melakukan pekerjaan dengan mengacu pada proses PDCA.', 'score' => 8],
                        'C' => ['text' => 'Berpedoman pada PDCA tetapi tidak konsisten pada setiap perkerjaan sehari - hari.', 'score' => 6],
                        'D' => ['text' => 'Cenderung tidak berpedoman pada proses PDCA dalam melaksanakan perkerjaannya sehari hari', 'score' => 4],
                        'E' => ['text' => 'Tidak pernah berpedoman pada proses PDCA dalam melaksanakan perkerjaannya sehari - hari', 'score' => 2],
                    ]
                ]
        ];

        return view('questions.index', compact('questions'));
    }

    // Proses submit form
    public function answer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:50',
            'jabatan' => 'required|string|max:100',
            'divisi' => 'required|string|max:100',
            'answers' => 'required|array',
        ]);

        // Ambil pertanyaan (harus sama dengan showQuestion)
        $questions = $this->getQuestions();

        $totalScore = 0;
        $answersWithScore = [];

        foreach ($request->answers as $qIndex => $choice) {
            $score = $questions[$qIndex]['options'][$choice]['score'] ?? 0;
            $answersWithScore[$qIndex] = [
                'choice' => $choice,
                'text' => $questions[$qIndex]['options'][$choice]['text'],
                'score' => $score,
            ];
            $totalScore += $score;
        }

        // Simpan ke database
        Question::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,
            'answers' => $answersWithScore,
            'total_score' => $totalScore,
        ]);

        return redirect()->route('questions.result')->with('success', 'Jawaban berhasil disimpan. Total Nilai: ' . $totalScore);
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
                    'A' => ['text' => 'Kualitas/Kuantitas selalu diatas standar/target', 'score' => 60],
                    'B' => ['text' => 'Kualitas/Kuantitas umumnya melebihi standar/target', 'score' => 48],
                    'C' => ['text' => 'Kualitas/Kuantitas mencapai standar/target', 'score' => 36],
                    'D' => ['text' => 'Kualitas/Kuantitas dibawah standar/target', 'score' => 24],
                    'E' => ['text' => 'Kualitas/Kuantitas jauh dibawah standar/target', 'score' => 12],
                ]
            ],
            [
                'aspek' => 'Sikap Kerja',
                'sub_aspek' => 'Perilaku',
                'pertanyaan' => 'Perilaku',
                'options' => [
                    'A' => ['text' => 'Selalu bersikap positif, cepat memahami & melaksanakan tugas dengan baik', 'score' => 4],
                    'B' => ['text' => 'Tidak Menyatakan keberatan, serta memahami & melaksanakan tugas dengan sungguh-sungguh', 'score' => 3],
                    'C' => ['text' => 'Sesekali melakukan penolakan, yang bersangkutan, memahami & menerima serta melaksanakan kebijakan', 'score' => 2],
                    'D' => ['text' => 'Sering menolak, kurang memahami dan melaksanakan kebijakan hanya dengan setengah hati', 'score' => 1],
                    'E' => ['text' => 'Hampir selalu menolak, tidak memahamai & melakasanakan kebijakan dengan semaunya', 'score' => 0],
                ]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Inisiatif',
                    'pertanyaan' => 'Inisiatif',
                    'options' => [
                        'A' => ['text' => 'Inisiatifnya sangat menonjol, mampu untuk melakukan perkerjaan atas prakasrsa sendiri', 'score' => 4],
                        'B' => ['text' => 'Berusaha melaksanakan perkerjaan atas prakarsa sendiri, kadang dengan inisiatifnya perlu diarahkan', 'score' => 3],
                        'C' => ['text' => 'Biasanya melakukan tugas ats petunjuk yang telah digariskan & mampu untuk menyelesaikan kasus-kasus tertentu', 'score' => 2],
                        'D' => ['text' => 'Masih harus mendapatkan dorongan untuk mencapai hasil rata - rata seperti yang diharapkan', 'score' => 1],
                        'E' => ['text' => 'Sikap kerjanya pasif & cepat jenuh dengan hasil kurang memuaskan, selalu harus didorong untuk menyelesaikan tugas', 'score' => 0],
                    ]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Disiplin',
                    'pertanyaan' => 'Disiplin',
                    'options' => [
                        'A' => ['text' => 'Selalu hadir sebelum waktu mulai kerja, keterlambatannya sangat beralasan & dapat dalam dipercaya penggunaan waktunya.', 'score' => 4],
                        'B' => ['text' => 'Hampir tidak pernah terlambat dan mampu menggunakan waktu kerjanya dengan sangat bertanggung jawab.', 'score' => 3],
                        'C' => ['text' => 'Cukup menghargai waktu kerja, kadang kadang terlambat dengan cukup beralasan', 'score' => 2],
                        'D' => ['text' => 'Seringkali terlambat hadir dan kurnag menghargai waktu kerja, alasan keterlambatan sering kurang meyakinkan', 'score' => 1],
                        'E' => ['text' => 'Hampir setiap kali terlambat masuk kerja & mangkir waktu kerja banyak terbuang untuk urusan luar perkerjaannya', 'score' => 0],
                    ]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Kerjasama',
                    'pertanyaan' => 'Kerjasama',
                    'options' => [
                        'A' => ['text' => 'Selalu terlibat dalam kerjasama & menjadi dinamisator kelompok kerjanya serta mengutamakan kepentingan kelompoknya.', 'score' => 4],
                        'B' => ['text' => 'Hampir selalu menunjukan hubungan kerja yang menyenangkan & giat melibatkan diri demi tercapai tujuan kelompok.', 'score' => 3],
                        'C' => ['text' => 'Pada umumnya hubungan dengan rekan sekerja/atasan baik, mau melibatkan diri demi tercapainya tujuan kelompok', 'score' => 2],
                        'D' => ['text' => 'kurang melibatkan diri dalam kegiatan kelompok & kadnag kadang menempatkan kepentingan pribadi diatas kepentingan kelompok', 'score' => 1],
                        'E' => ['text' => 'Sikapnya acuh tak acuh terhadap rekan sekerja & sulit diajak kerja sama serta tidak mau melibatkan diri dalam kegiatan berkelompok', 'score' => 0],
                    ]
                ],
                [
                    'aspek' => 'Sikap Kerja',
                    'sub_aspek' => 'Tanggung Jawab',
                    'pertanyaan' => 'Tanggung Jawab',
                    'options' => [
                        'A' => ['text' => 'Kemampuannya untuk menyelesaikan tugas berat telah teruji, gigih, dan positif dalam menghadapi tambahan beban kerja.', 'score' => 4],
                        'B' => ['text' => 'Bertambahnya beban kerja dapat diterima dengan baik, cara kerjanya sangat efektif sehingga mudah menghadapi rintangan /tekanan.', 'score' => 3],
                        'C' => ['text' => 'Masih dapat menyelesaikan tugasnya dengan baik meskipun rintangan atau bertambahnya beban kerja', 'score' => 2],
                        'D' => ['text' => 'Biasanya beban kerjanya terganggu bila menghadapi rintangan / tekanan, bersikap negatif dalam menghadapi beban kerja yang berat', 'score' => 1],
                        'E' => ['text' => 'Hampir selalu menyerah dan tidak mampu menyelesaikan perkerjaan bila menemu rintangan, bersikap negatif bila ada beban kerja berat.', 'score' => 0],
                    ]
                ],
                [
                    'aspek' => 'Kemampuan Kerja',
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
                [
                    'aspek' => 'Kemampuan Kerja',
                    'sub_aspek' => 'Proses PDCA',
                    'pertanyaan' => 'Proses PDCA',
                    'options' => [
                        'A' => ['text' => 'Selalu memutar roda PDCA secara konsisten pada tiap permasalahan / perkerjaan yang dihadapi sehari - hari.', 'score' => 10],
                        'B' => ['text' => 'Selalu berusaha melakukan pekerjaan dengan mengacu pada proses PDCA.', 'score' => 8],
                        'C' => ['text' => 'Berpedoman pada PDCA tetapi tidak konsisten pada setiap perkerjaan sehari - hari.', 'score' => 6],
                        'D' => ['text' => 'Cenderung tidak berpedoman pada proses PDCA dalam melaksanakan perkerjaannya sehari hari', 'score' => 4],
                        'E' => ['text' => 'Tidak pernah berpedoman pada proses PDCA dalam melaksanakan perkerjaannya sehari - hari', 'score' => 2],
                    ]
                ]
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

    public function result(Request $request)
    {
        $divisi = $request->get('divisi');
        $tahunMulai = $request->get('tahun_mulai');
        $tahunAkhir = $request->get('tahun_akhir');

        $query = Question::select(
                'name',
                'nik',
                'jabatan',
                'divisi',
                DB::raw('AVG(total_score) as avg_score')
            )
            ->groupBy('name', 'nik', 'jabatan', 'divisi');

        // filter divisi
        if ($divisi) {
            $query->where('divisi', $divisi);
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

        return view('questions.result', compact('results', 'divisions'));
    }

    public function downloadPdf(Request $request)
    {
        $divisi = $request->get('divisi');
        $tahunMulai = $request->get('tahun_mulai');
        $tahunAkhir = $request->get('tahun_akhir');

        // kalau tabelnya memang score_kpi → pakai DB::table
        $query = DB::table('score_kpi')
            ->select(
                'name',
                'nik',
                'jabatan',
                'divisi',
                DB::raw('AVG(total_score) as avg_score')
            )
            ->groupBy('name', 'nik', 'jabatan', 'divisi');

        if ($divisi) {
            $query->where('divisi', $divisi);
        }

        $driver = DB::getDriverName();

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

        // $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('questions.result-pdf', compact('results', 'divisi', 'tahunMulai', 'tahunAkhir'));
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('questions.result-pdf', [
            'results'    => $results,
            'divisi'     => $divisi,
            'tahunMulai' => $tahunMulai,
            'tahunAkhir' => $tahunAkhir
        ]);
        return $pdf->download('hasil_penilaian_rata2.pdf');
    }
}
