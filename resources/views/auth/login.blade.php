<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="images/logobiofarmakecil.png">
    <style>
        body {
        margin: 0;
        padding: 0;
        height: 100vh; /* Pastikan body memenuhi layar penuh */
        background: linear-gradient(to top, #adace9, #ffffff 50%, transparent 50%); /* Gradasi dari bawah ke atas, hanya sampai setengah */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .min-vh-100 {
        background: white; /* Warna putih untuk card form */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        padding: 20px;
        max-width: 400px;
        width: 100%;
    }

    html, body {
        overflow: hidden; /* Menghindari scroll jika terjadi elemen tambahan */
    }

    button.btn-primary {
        background: #4B49AC;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 20px;
        transition: background 0.3s ease-in-out;
    }

    button.btn-primary:hover {
        background: #362f80; /* Warna lebih gelap saat hover */
    }

    .form-check-input {
        margin-right: 10px;
    }

    /* .form-check {
        display: flex;
        align-items: center;
    } */
    .remember-me-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        margin-left: 20px;
    }

    .remember-checkbox {
        margin-right: 8px;
    }

    .remember-label {
        font-size: 14px;
        cursor: pointer;
    }
    </style>
</head>
<body>
    {{-- <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light"> --}}
        <div class="bg-white p-4 rounded-lg shadow w-100" style="max-width: 400px;">
            <div class="text-center mb-4">
                <img src="images/logobiofarmakecil.png" alt="Biofarma Logo" class="img-fluid" style="height: 50px;">
                <h2 class="mt-3 text-dark font-weight-bold">Sign in to your account</h2>
            </div>

            <!-- Alert Message -->
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email" class="text-muted">Email address</label>
                    <input id="email" name="email" type="email" required class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" value="{{ old('email') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password" class="text-muted">Password</label>
                    <span class="password-toggle-icon"><i class="fas fa-eye"></i></span>
                    <input id="password" name="password" type="password" required class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    {{-- <div class="form-check"> --}}
                        <div class="remember-me-container">
                        <input id="remember_me" name="remember" type="checkbox" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember_me" class="form-check-label">Remember me</label>
                        </div>
                    {{-- </div> --}}
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
            <p class="mt-4 text-center text-muted">
                Not a member? 
                <a href="/register" class="text-primary">Register now</a>
            </p>
        </div>
    </div>

    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="script.js"></script>
</body>
</html>
