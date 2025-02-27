<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Arena Sports</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('templates/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/assets/css/pages/auth.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-6 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
            <div class="col-lg-6 col-12 bg-ligth">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="/"><img src="{{ asset('templates/assets/images/logo/arena_sport.png') }}"
                                alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Pendaftaran</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <p class="auth-subtitle mb-5">Ayo Daftar Diri Anda di <b>ARENA SPORTS</b> melakukan Booking Olahraga
                    </p>

                    <form method="POST" action="{{ route('register.user') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control" name="name" class="form-control"
                                placeholder="Nama Lengkap" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Konfirmasi Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-warning btn-block btn-lg shadow-lg mt-5">Daftar</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Sudah Punya Akun? <a href="/login"
                                class="font-bold text-warning">Masuk</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Hapus alert secara otomatis setelah 5 detik (5000ms)
    setTimeout(function() {
        let alert = document.querySelector(".alert");
        if (alert) {
            alert.classList.add("fade");
            setTimeout(() => alert.remove(), 500); // Hilangkan dari DOM
        }
    }, 5000);
</script>
</html>
