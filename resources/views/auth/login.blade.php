@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0" style="width: 420px; border-radius: 12px;">
        <div class="card-body">
            <h3 class="text-center mb-4 fw-bold text-dark">Login</h3>

            {{-- Form --}}
            <form method="POST" action="{{ route('login.submit') }}" id="loginForm">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control shadow-sm" id="email"
                           name="email" value="{{ old('email') }}"
                           placeholder="Email@example.com" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group shadow-sm">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button type="button" class="btn btn-outline-dark" id="togglePassword">
                            <i class="fa fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    {{-- Indikator kekuatan password --}}
                    <small id="passwordStrength" class="fw-semibold mt-1 d-block"></small>
                </div>

                <button type="submit" class="btn btn-dark w-100 fw-bold shadow-sm" id="loginBtn">
                    <span id="loginText"><i class="fa fa-sign-in-alt me-1"></i> Login</span>
                    <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none"></span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Toastr --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#loginForm");
    const loginBtn = document.querySelector("#loginBtn");
    const loginText = document.querySelector("#loginText");
    const spinner = document.querySelector("#loadingSpinner");
    const emailInput = document.querySelector("#email");
    const passwordInput = document.querySelector("#password");
    const togglePassword = document.querySelector("#togglePassword");
    const toggleIcon = document.querySelector("#toggleIcon");
    const passwordStrength = document.querySelector("#passwordStrength");

    // 🟢 Autofocus saat halaman dibuka
    emailInput.focus();

    // 🟢 Enter key trigger login
    form.addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            form.requestSubmit();
        }
    });

    // 🟢 Toggle password visibility
    togglePassword.addEventListener("click", function () {
        const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        passwordInput.setAttribute("type", type);
        toggleIcon.classList.toggle("fa-eye");
        toggleIcon.classList.toggle("fa-eye-slash");
    });

    // 🟢 Password strength indicator
    passwordInput.addEventListener("input", function() {
        const val = passwordInput.value;
        let strength = 0;
        if (val.match(/[a-z]+/)) strength++;
        if (val.match(/[A-Z]+/)) strength++;
        if (val.match(/[0-9]+/)) strength++;
        if (val.match(/[$@#&!]+/)) strength++;
        if (val.length >= 8) strength++;

        const strengthLabels = ["Sangat Lemah", "Lemah", "Sedang", "Kuat", "Sangat Kuat"];
        const strengthColors = ["#dc3545", "#fd7e14", "#ffc107", "#198754", "#0d6efd"];
        passwordStrength.textContent = val ? `Kekuatan: ${strengthLabels[strength-1] || 'Sangat Lemah'}` : '';
        passwordStrength.style.color = strengthColors[strength-1] || '#dc3545';
    });

    // 🟢 Loading animasi saat submit
    form.addEventListener("submit", function() {
        loginBtn.disabled = true;
        loginText.classList.add("d-none");
        spinner.classList.remove("d-none");
    });

    // 🟢 Toastr feedback
    @if (session('success'))
        toastr.success("{{ session('success') }}", "Berhasil", { timeOut: 3000, progressBar: true });
    @endif

    @if ($errors->any())
        toastr.error("{{ implode('\n', $errors->all()) }}", "Gagal", { timeOut: 4000, progressBar: true });
    @endif
});
</script>
@endpush
