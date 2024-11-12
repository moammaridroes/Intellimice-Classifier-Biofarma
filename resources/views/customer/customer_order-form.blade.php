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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        .custom-swal-icon {
            margin-top: 20px; /* Adjust this to move the icon down */
        }
        .custom-swal-popup {
            padding-top: 40px; /* Adjust to increase spacing between title and icon */
        }
        .language-icon {
            font-size: 1.5rem; /* Atur ukuran ikon */
            margin-right: 7px; /* Spasi antara ikon dan teks */
            color: #000000; /* Warna ikon */
        }
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

        /* Tambahan CSS untuk Sidebar Responsif */
        .mobile-menu-btn {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            margin-right: 10px;
        }

        .close-sidebar-btn {
            display: none;
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 1.5rem;
            cursor: pointer;
            color: #333;
        }

        @media (max-width: 767px) {
            .mobile-menu-btn {
                display: inline;
            }

            .sidebar-offcanvas {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 250px;
                height: 100vh;
                background-color: #ffffff;
                z-index: 1050;
                padding-top: 60px;
                border-right: 1px solid #ddd;
            }

            .sidebar-offcanvas.active {
                display: block;
            }

            .sidebar-offcanvas.active .close-sidebar-btn {
                display: inline;
            }
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:_navbar.blade.php -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{ url('/customer/home') }}">
                    <img src="{{ asset('images/Logo_Bio_Farma.png') }}" style="width: 65%; height: 65%;" class="mr-2"
                        alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('/customer/home') }}">
                    <img src="{{ asset('images/logobiofarmakecil.png') }}" alt="logo" />
                </a>
            </div>

            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                <!-- Tombol untuk tampilan mobile -->
                <span class="mobile-menu-btn" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </span>

                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <div class="d-flex align-items-center ml-auto">
                    <div class="nav-item dropdown mr-4">
                        <a class="nav-link p-0" href="#" data-toggle="dropdown" id="languageDropdown">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="black" d="m12 22l-1-3H4q-.825 0-1.412-.587T2 17V4q0-.825.588-1.412T4 2h6l.875 3H20q.875 0 1.438.563T22 7v13q0 .825-.562 1.413T20 22zm-4.85-7.4q1.725 0 2.838-1.112T11.1 10.6q0-.2-.012-.362t-.063-.338h-3.95v1.55H9.3q-.2.7-.763 1.088t-1.362.387q-.975 0-1.675-.7T4.8 10.5t.7-1.725t1.675-.7q.45 0 .85.163t.725.487L9.975 7.55Q9.45 7 8.712 6.7T7.15 6.4q-1.675 0-2.863 1.188T3.1 10.5t1.188 2.913T7.15 14.6m6.7.5l.55-.525q-.35-.425-.637-.825t-.563-.85zm1.25-1.275q.7-.825 1.063-1.575t.487-1.175h-3.975l.3 1.05h1q.2.375.475.813t.65.887M13 21h7q.45 0 .725-.288T21 20V7q0-.45-.275-.725T20 6h-8.825l1.175 4.05h1.975V9h1.025v1.05H19v1.025h-1.275q-.25.95-.75 1.85T15.8 14.6l2.725 2.675L17.8 18l-2.7-2.7l-.9.925L15 19z"/></svg>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="languageDropdown">
                            <a class="dropdown-item" href="{{ url('locale/en') }}">English</a>
                            <a class="dropdown-item" href="{{ url('locale/id') }}">Bahasa Indonesia</a>
                        </div>
                    </div>
        
                    <div class="nav-item dropdown">
                        <span class="text-black font-weight-bold mr-2">
                            {{ Auth::user()->name }}
                        </span>
        
                        <a class="nav-link p-0" href="#" data-toggle="dropdown" id="profileDropdown">
                            <div class="d-flex justify-content-center">
                                <svg class="fill-current text-black" width="20" height="20"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </a>
        
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>


        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <span class="close-sidebar-btn" onclick="toggleSidebar()">
                    <i class="fas fa-times"></i>
                </span>
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
                            <h4 class="card-title">@lang('messages.order_form')</h4>
                            <div class="form-container">
                                <div class="form-section">
                                    <h5>Customer Information</h5>
                                    <form id="orderForm" method="POST" action="{{ route('customer.orders.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="fullname">@lang('messages.fullname')</label>
                                            <input type="text" class="form-control" name="fullname" maxlength="40" placeholder="@lang('messages.fullname')" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number">@lang('messages.phone_number')</label>
                                            <input type="number" class="form-control" name="phone_number" placeholder="@lang('messages.phone_number')" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">@lang('messages.email')</label>
                                            <input type="email" class="form-control" name="email" placeholder="@lang('messages.email')" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="agency_name">@lang('messages.agency_name')</label>
                                            <input type="text" class="form-control" name="agency_name" placeholder="@lang('messages.agency_name')" required>
                                            <small class="form-text text-muted">@lang('messages.enter_dash_if_none')</small>
                                        </div>
                                        <h5>Order Information</h5>
                                        <div class="form-group">
                                            <label for="item_name">@lang('messages.item_name')</label>
                                            <select class="form-control" name="item_name" required>
                                                <option value="" disabled selected>@lang('select item')</option>
                                                <option value="Mencit">Mencit</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="pick_up_date">@lang('messages.pick_up_date')</label>
                                            <input type="date" class="form-control" name="pick_up_date" placeholder="@lang('messages.pick_up_date')" required>
                                        </div>
                                </div>

                                <div class="form-section">
                                    <div class="form-group">
                                        <label for="weight">@lang('messages.weight')</label>
                                        <select class="form-control" name="weight" id="weightSelect">
                                            <option value="" selected disabled>Select Weight</option>
                                            <option value="less_than_8">&lt;8g</option>
                                            <option value="between_8_and_14">8-14g</option>
                                            <option value="between_14_and_18">14-18g</option>
                                            <option value="greater_equal_18">&gt;18g</option>
                                          </select>
                                    </div>
                                    <h4 class="card-title">Set amount of order</h4>
                                    <div class="form-group">
                                        <div class="form-check form-check-flat form-check-primary">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" id="maleCheckbox">@lang('messages.male')
                                            </label>
                                        </div>
                                        <input type="number" class="form-control form-control-lg" id="maleQuantity" name="male_quantity" placeholder="@lang('messages.quantity')" min="1" value="0" oninput="validateAndCalculate(this)" disabled>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check form-check-flat form-check-primary">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" id="femaleCheckbox"> @lang('messages.female')
                                            </label>
                                        </div>
                                        <input type="number" class="form-control form-control-lg" id="femaleQuantity" name="female_quantity" placeholder="@lang('messages.quantity')" min="1" value="0" oninput="validateAndCalculate(this)" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('messages.total')</label>
                                        <input type="number" class="form-control form-control-lg" id="totalQuantity" placeholder="@lang('messages.total')" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('messages.total_price')</label>
                                        <input type="text" class="form-control form-control-lg" id="totalPrice" placeholder="@lang('messages.total_price')" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="notes">@lang('messages.notes')</label>
                                        <textarea class="form-control" name="notes" rows="3" placeholder="@lang('messages.notes')" maxlength="500"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2" style="background-color: #4B49AC; border-color: #4B49AC;">@lang('messages.submit')</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("active");
        }
        document.getElementById('orderForm').addEventListener('submit', function (e) {
        // Prevent the form from submitting immediately
        e.preventDefault();
        
        // Show SweetAlert confirmation
        Swal.fire({
        title: "Do you want to submit this order?",
        text: "Please confirm your order details before submitting.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#4B49AC",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, submit it!",
        customClass: {
            popup: 'custom-swal-popup', // Apply this class to the entire popup for layout adjustments
            icon: 'custom-swal-icon' // Adjust the icon specifically
        }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Order Submitted!",
                    text: "Your order has been submitted successfully.",
                    icon: "success",
                    customClass: {
                        popup: 'custom-swal-popup',
                        icon: 'custom-swal-icon'
                    }
                }).then(() => {
                    e.target.submit();
                });
            } else {
                Swal.fire("Order was not submitted!", "", "info");
            }
        });
    });


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
            var totalPrice = (maleQuantity * 4000) + (femaleQuantity * 5000);

            document.getElementById('totalQuantity').value = totalQuantity;
            document.getElementById('totalPrice').value = totalPrice.toLocaleString('id-ID');
        }
    </script>

</body>

</html>
