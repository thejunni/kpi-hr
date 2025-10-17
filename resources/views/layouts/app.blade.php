<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Aplikasi Penilaian Kinerja</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

	<style>
		/* 🌟 Navbar gradasi animasi emas-hitam */
		.navbar-gradient {
			position: relative;
			background: linear-gradient(120deg, #000000, #2b2b2b, #d4af37, #000000);
			background-size: 400% 400%;
			animation: gradientShift 10s ease infinite;
			box-shadow: 0 3px 10px rgba(0, 0, 0, 0.4);
			overflow: hidden;
			z-index: 1;
		}

		/* ✨ Overlay transparan */
		.navbar-gradient::before {
			content: "";
			position: absolute;
			inset: 0;
			background: rgba(255, 255, 255, 0.05);
			backdrop-filter: blur(6px);
			z-index: 0;
		}

		/* 🔄 Animasi gradasi */
		@keyframes gradientShift {
			0% {
				background-position: 0% 50%;
			}

			50% {
				background-position: 100% 50%;
			}

			100% {
				background-position: 0% 50%;
			}
		}

		/* 🔹 Teks dan tombol */
		.navbar-brand {
			font-weight: bold;
			letter-spacing: 0.5px;
			color: #ffd700 !important;
			text-shadow: 0 0 8px rgba(255, 215, 0, 0.5);
			position: relative;
			z-index: 2;
		}

		.navbar-brand:hover {
			color: #fff !important;
			text-shadow: 0 0 12px rgba(255, 255, 255, 0.8);
		}

		.navbar-text {
			font-weight: 500;
			color: #f8f9fa;
			position: relative;
			z-index: 2;
		}

		.btn-outline-light {
			border-color: #f5f5f5;
			color: #f5f5f5;
			transition: all 0.3s ease;
			position: relative;
			z-index: 2;
		}

		.btn-outline-light:hover {
			background-color: #d4af37;
			color: #000;
			border-color: #d4af37;
			box-shadow: 0 0 10px rgba(212, 175, 55, 0.6);
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark navbar-gradient">
		<div class="container">
			<a class="navbar-brand" href="{{ route('dashboard') }}">
				Panel HRD BPR KAS
			</a>
			<div class="d-flex align-items-center">
				@auth
				<span class="navbar-text me-3">
					<i class="fa-solid fa-user me-1"></i>{{ Auth::user()->name }}
				</span>
				<form method="POST" action="{{ route('logout') }}" class="p-1">
					@csrf
					<button class="btn btn-sm btn-outline-light">
						<i class="fa-solid fa-right-from-bracket me-1"></i>Logout
					</button>
				</form>
				@endauth
			</div>
		</div>
	</nav>

	<main class="py-4">
		@yield('content')
	</main>

	@yield('scripts')

	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	@stack('scripts')
</body>

</html>
