<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->

    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->

    <link rel="shortcut icon" href="images/logobiofarmakecil.png" />

    <style>
        /* Add padding to properly space the checkbox and label */
        .form-check-input {
            margin-right: 10px;
        }

        .form-check {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="bg-white p-4 rounded-lg shadow w-100" style="max-width: 400px;">
            <div class="text-center mb-4">
                <img src="images/logobiofarmakecil.png" alt="Biofarma Logo" class="img-fluid" style="height: 50px;">
                <h2 class="mt-3 text-dark font-weight-bold">Sign in to your account</h2>
            </div>

            <!-- Alert Message -->
            @if ($errors->has('login_error'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('login_error') }}
                </div>
            @endif

            <form method="POST" action="/login">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="email" class="text-muted">Email address</label>
                    <input id="email" name="email" type="email" required class="form-control" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="password" class="text-muted">Password</label>
                    <input id="password" name="password" type="password" required class="form-control" placeholder="Enter your password">
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input id="remember_me" name="remember" type="checkbox" class="form-check-input">
                        <label for="remember_me" class="form-check-label">Remember me</label>
                    </div>
                    <!-- <a href="/password/request" class="text-primary">Forgot your password?</a> -->
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
            <p class="mt-4 text-center text-muted">
                Not a member? 
                <a href="/register" class="text-primary">Register now</a>
            </p>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
</body>

</html>
