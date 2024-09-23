<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->

    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->

    <link rel="shortcut icon" href="images/logobiofarmakecil.png" />
</head>

<body>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="bg-white p-4 rounded-lg shadow w-100" style="max-width: 400px;">
            <div class="text-center mb-4">
                <img src="images/logobiofarmakecil.png" alt="Biofarma Logo" class="img-fluid" style="height: 100px;">
                <h2 class="mt-3 text-dark font-weight-bold">Create your account</h2>
            </div>
            <form method="POST" action="/register">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name" class="text-muted">Name</label>
                    <input id="name" name="name" type="text" required class="form-control" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="email" class="text-muted">Email address</label>
                    <input id="email" name="email" type="email" required class="form-control" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="password" class="text-muted">Password</label>
                    <input id="password" name="password" type="password" required class="form-control" placeholder="Create a password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="text-muted">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required class="form-control" placeholder="Confirm your password">
                </div>
                <!-- <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check d-flex align-items-center">
                        <input id="terms" name="terms" type="checkbox" class="form-check-input" style="margin-right: 5px;" required>
                        <label for="terms" class="form-check-label mb-0">I agree to the terms</label>
                    </div>
                </div> -->
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
            <p class="mt-4 text-center text-muted">
                Already have an account? 
                <a href="/login" class="text-primary">Sign in here</a>
            </p>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
</body>

</html>
