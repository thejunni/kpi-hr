@switch($matrixTitle)
@case('Stars')
<ol class="mb-0">
	<li>Dapat dipromosikan</li>
	<li>Memperluas ruang lingkup kerja dan menyediakan tantangan yang lebih baik</li>
	<li>Pelatihan khusus terkait GAP kompetensi dalam pekerjaan individu ybs</li>
</ol>
@break

@case('Eagles')
<ol class="mb-0">
	<li>Memanage apa yang diharapkan oleh ybs</li>
	<li>Promosikan pada area kerja yang berkaitan</li>
	<li>Uji kemampuan di luar core competency ybs</li>
</ol>
@break

@case('Prince in Waiting')
<ol class="mb-0">
	<li>Berikan penugasan yang lebih menantang</li>
	<li>Tingkatkan pengalaman dan eksposur kerja</li>
	<li>Manajemen ekspektasi secara periodik</li>
</ol>
@break

@case('Critical List')
<ol class="mb-0">
	<li>Perlunya monitoring dan konseling</li>
	<li>Pantau kembali kemampuan serta ruang lingkup kerja ybs</li>
</ol>
@break

@case('No Hopers')
<ol class="mb-0">
	<li>Koordinasikan untuk dipertahankan atau dikeluarkan</li>
</ol>
@break

@case('Cadre')
<ol class="mb-0">
	<li>Kelola tantangan agar tidak selalu berada di grup ini</li>
	<li>Perlu mentoring dan pelatihan</li>
</ol>
@break

@case('Misfits')
<ol class="mb-0">
	<li>Perlunya monitoring dan konseling</li>
	<li>Segera kelola ulang ruang lingkup pekerjaannya</li>
</ol>
@break

@case('Foot Soldiers')
<ol class="mb-0">
	<li>Atur target yang hendak dicapai dari performance kerjanya</li>
	<li>Monitoring kinerja ybs secara ketat</li>
</ol>
@break

@case('Workhorse')
<ol class="mb-0">
	<li>Kenalkan ybs pada pencapaian-pencapaian dan berikan dukungan</li>
	<li>Berikan pelatihan untuk meningkatkan skill</li>
</ol>
@break

@default
<em>Tidak ada rekomendasi improvement</em>
@endswitch