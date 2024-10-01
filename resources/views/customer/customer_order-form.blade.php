<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Order Form</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/logobiofarmakecil.png') }}" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-group {
            margin-bottom: 1rem;
        }

        .error-message {
            display: none;
            color: red;
        }

        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-section {
            flex: 1;
            min-width: 300px;
            max-width: 50%;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        @media (max-width: 768px) {
            .form-section {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- Navbar -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{ url('/') }}">
                    <img src="{{ asset('images/Logo_Bio_Farma.png') }}" style="width: 65%; height: 65%;" class="mr-2" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
                    <img src="{{ asset('images/logobiofarmakecil.png') }}" alt="logo" />
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('customer/home') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('customer/notification') }}">
                            <i class="ti-bell menu-icon"></i>
                            <span class="menu-title">Notification</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                            <i class="icon-columns menu-icon"></i>
                            <span class="menu-title">Order</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ url('customer/orderform') }}">Order Forms</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('customer/history') }}">Order History</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="card-title">Order Form</h4>
                            <div class="form-container">
                                <div class="form-section">
                                    <h5>Customer Information</h5>
                                    <form method="POST" action="{{ route('customer.orders.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="fullname">Fullname</label>
                                            <input type="text" class="form-control" name="fullname" placeholder="Fullname" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="number" class="form-control" name="phone_number" placeholder="Phone Number" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="agency_name">Agency Name</label>
                                            <input type="text" class="form-control" name="agency_name" placeholder="Agency Name" required>
                                        </div>
                                        <h5>Order Information</h5>
                                        <div class="form-group">
                                            <label for="item_name">Name of item ordered</label>
                                            <input type="text" class="form-control" name="item_name" placeholder="Name of item ordered" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pick_up_date">Pick Up Date</label>
                                            <input type="date" class="form-control" name="pick_up_date" placeholder="Pick Up Date" required>
                                        </div>
                                </div>

                                <div class="form-section">
                                    <div class="form-group">
                                        <label for="weight">Weight (gr)</label>
                                        <input type="number" class="form-control" name="weight" id="weightInput" placeholder="Weight Ordered (gr)" required oninput="validateWeight()">
                                        <div id="weightError" class="error-message">Please input weight more than 0</div>
                                    </div>
                                    <h4 class="card-title">Set amount of order</h4>
                                    <div class="form-group">
                                        <div class="form-check form-check-flat form-check-primary">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" id="maleCheckbox"> Male
                                            </label>
                                        </div>
                                        <input type="number" class="form-control form-control-lg" id="maleQuantity" name="male_quantity" placeholder="Quantity" min="1" value="0" oninput="validateAndCalculate(this)" disabled>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check form-check-flat form-check-primary">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" id="femaleCheckbox"> Female
                                            </label>
                                        </div>
                                        <input type="number" class="form-control form-control-lg" id="femaleQuantity" name="female_quantity" placeholder="Quantity" min="1" value="0" oninput="validateAndCalculate(this)" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="number" class="form-control form-control-lg" id="totalQuantity" placeholder="Total" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea class="form-control" name="notes" rows="3" placeholder="Enter any additional notes (max 500 characters)" maxlength="500"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2" style="background-color: #4B49AC; border-color: #4B49AC;">Submit</button>
                                    <button type="reset" class="btn btn-light">Reset</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024, Biofarma. STAS-RG. All rights reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript functions for the form interactions
        function validateWeight() {
            var weightInput = document.getElementById('weightInput');
            var errorDiv = document.getElementById('weightError');
            var weightValue = parseInt(weightInput.value) || 0;

            if (weightValue <= 0) {
                weightInput.style.borderColor = 'red';
                errorDiv.style.display = 'block'; 
            } else {
                weightInput.style.borderColor = '';
                errorDiv.style.display = 'none';
            }
        }

        function validateAndCalculate(input) {
            if (input.value < 0) {
                input.value = 0;
            }
            calculateTotal();
        }

        document.getElementById('maleCheckbox').addEventListener('change', function () {
            toggleInput('maleQuantity', this.checked);
        });

        document.getElementById('femaleCheckbox').addEventListener('change', function () {
            toggleInput('femaleQuantity', this.checked);
        });

        function toggleInput(inputId, isChecked) {
            var input = document.getElementById(inputId);
            input.disabled = !isChecked;
            if (isChecked) {
                input.value = '';
                input.focus();
            } else {
                input.value = 0;
                calculateTotal();
            }
        }

        function calculateTotal() {
            var maleQuantity = parseInt(document.getElementById('maleQuantity').value) || 0;
            var femaleQuantity = parseInt(document.getElementById('femaleQuantity').value) || 0;
            var totalQuantity = maleQuantity + femaleQuantity;
            document.getElementById('totalQuantity').value = totalQuantity;
        }
    </script>
</body>

</html>
