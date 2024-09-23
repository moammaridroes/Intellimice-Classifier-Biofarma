<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Forgot Password</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->

    <link rel="shortcut icon" href="{{ asset('images/logobiofarmakecil.png') }}" />
</head>

<body>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="bg-white p-4 rounded-lg shadow w-100" style="max-width: 400px;">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logobiofarmakecil.png') }}" alt="Biofarma Logo" class="img-fluid" style="height: 100px;">
                <h2 class="mt-3 text-dark font-weight-bold">Reset Your Password</h2>
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email" class="text-muted">Email address</label>
                    <input id="email" name="email" type="email" required class="form-control" placeholder="Enter your email">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
            </form>

            <div class="mt-3 text-center">
                <a href="/login" class="btn btn-link text-muted">Back to login</a>
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
</body>

</html>
