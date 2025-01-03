<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Your Notifications</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/logobiofarmakecil.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Custom CSS for Notifications -->
    <style>
        .language-icon {
            font-size: 1.5rem;
            margin-right: 7px;
            color: #000000;
        }

        .notification-card {
            padding: 8px 15px;
            margin-bottom: 8px;
            border-radius: 4px;
            background-color: #f8f9fa;
            border-left: 4px solid;
            display: flex;
            align-items: center;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .notification-card h5 {
            margin: 0 0 4px 0;
            font-size: 1rem;
        }

        .notification-card p {
            margin: 0;
            font-size: 0.9rem;
        }

        .status-approved {
            border-color: #28a745;
            background-color: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            border-left: 4px solid #ffc107;
        }

        .notification-date-header {
            font-weight: bold;
            font-size: 1rem;
            margin: 15px 0 10px 0;
            color: #343a40;
        }

        .main-panel {
            padding: 20px;
        }

        /* Tambahan CSS untuk tombol menu di tampilan mobile */
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

        /* Sidebar penuh ke bawah */
        .sidebar-offcanvas {
            height: 100vh;
            overflow-y: auto;
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
                width: 200px;
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
            <!-- Sidebar End -->

            <!-- Main Content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div>
                                <h4 class="card-title">@lang('messages.notifications')</h4>
                                <div class="row">
                                    @php
                                    // Urutkan orders berdasarkan created_at secara descending dan kelompokkan berdasarkan tanggal
                                    $groupedOrders = $orders->sortByDesc('created_at')->groupBy(function($order) {
                                    return \Carbon\Carbon::parse($order->created_at)->format('d-m-Y');
                                    });
                                    @endphp

                                    @foreach($groupedOrders as $date => $dailyOrders)
                                    <div class="col-12">
                                        <div class="notification-date-header">{{ $date }}</div>
                                    </div>
                                    @foreach($dailyOrders as $order)
                                    <div class="col-12">
                                        <div class="notification-card status-{{ $order->status }}">
                                            <div class="notification-info">
                                                <h5>{{ $order->item_name }}</h5>
                                                <p><strong>@lang('messages.status') :</strong> {{ ucfirst($order->status) }}</p>
                                                <p>
                                                    @if($order->status == 'approved')
                                                        @lang('messages.approved_message') <strong>{{ \Carbon\Carbon::parse($order->pick_up_date)->format('d-m-Y') }}</strong>
                                                    @elseif($order->status == 'rejected')
                                                        @lang('messages.rejected_message')
                                                    @else
                                                        @lang('messages.pending_message')
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                @include('partials.footer')
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>

    <!-- JavaScript untuk toggle sidebar -->
    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("active");
        }
    </script>
</body>

</html>
