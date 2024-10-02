<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>

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
                <h2 class="mt-3 text-dark font-weight-bold">Create your account</h2>
            </div>

            <!-- Alert for validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name" class="text-muted">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required class="form-control" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="email" class="text-muted">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required class="form-control" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="password" class="text-muted">Password</label>
                    <input id="password" name="password" type="password" required class="form-control" placeholder="Create a password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="text-muted">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required class="form-control" placeholder="Confirm your password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>

            <p class="mt-4 text-center text-muted">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-primary">Sign in here</a>
            </p>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
</body>

</html>
