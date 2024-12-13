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
        @include('partials.navbarCustomer')

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
                                            <option value="category1">&lt;10g</option>
                                            <option value="category2">10-22g</option>
                                            <option value="category3">&gt;22g</option>
                                            {{-- <option value="category4">&gt;18g</option> --}}
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
                @include('partials.footer')
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
    const maleQuantity = parseInt(document.querySelector("input[name='male_quantity']").value) || 0;
    const femaleQuantity = parseInt(document.querySelector("input[name='female_quantity']").value) || 0;

    // Ambil harga dari konfigurasi PHP (dari backend)
    const malePrices = @json(config('mice.prices.male'));
    const femalePrices = @json(config('mice.prices.female'));
    const selectedWeight = document.querySelector("select[name='weight']").value;

    // Kalkulasi total harga berdasarkan kategori
    const malePrice = malePrices[selectedWeight] || 0;
    const femalePrice = femalePrices[selectedWeight] || 0;

    const totalPrice = (maleQuantity * malePrice) + (femaleQuantity * femalePrice);
    document.getElementById("totalPrice").value = totalPrice.toLocaleString('id-ID');
    return totalPrice;
}

    </script>

</body>

</html>
