<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
        <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
        
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="shortcut icon" href="{{ asset('images/logobiofarmakecil.png') }}">
    
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <style>
        /* Animasi untuk fade-in */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            opacity: 0;
            animation: fadeIn 1s ease forwards;
        }

        .card:nth-child(1) { animation-delay: 0.2s; }
        .card:nth-child(2) { animation-delay: 0.4s; }
        .card:nth-child(3) { animation-delay: 0.6s; }
        .card:nth-child(4) { animation-delay: 0.8s; }
        .card:nth-child(5) { animation-delay: 1s; }

        /* Layout default untuk laptop/PC */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .card-row-1 {
            display: flex;
            justify-content: space-between;
            max-width: 1000px;
            width: 100%;
        }

        .card-row-2 {
            display: flex;
            justify-content: center;
            max-width: 600px;
            width: 100%;
        }

        .card {
            flex: 1;
            min-width: 250px;
            margin: 10px;
        }
        /* Styling tabel */
        .table-container {
            margin-top: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        table.dataTable {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        .dataTables_wrapper {
            padding: 20px;
        }

        table.dataTable thead th {
            background-color: #4B49AC;
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 15px;
            border-bottom: 2px solid #dee2e6;
            border-right: 1px solid #ffffff;
        }

        table.dataTable thead th:last-child {
            border-right: none;
        }

        table.dataTable tbody td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            transition: background-color 0.3s;
        }

        table.dataTable tbody tr:last-child td {
            border-bottom: none;
        }

        table.dataTable tbody tr:hover {
            background-color: #f1f3f5;
            transform: scale(1.01);
        }

        .dataTables_info, .dataTables_paginate {
            margin-top: 15px;
            color: #4B49AC;
        }

        .dataTables_filter input, .dataTables_length select {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 8px 12px;
            transition: border-color 0.3s;
        }

        .dataTables_filter input:focus, .dataTables_length select:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .page-item.active .page-link {
            background-color: #4B49AC;
            border-color: #4B49AC;
        }

        /* Gaya untuk ikon */
        .details-button, .edit-button, .delete-button {
            cursor: pointer;
            color: #4B49AC;
            font-size: 1.2em;
        }

        .details-button:hover, .edit-button:hover, .delete-button:hover {
            color: #0056b3;
        }

        /* Responsif */
        @media (max-width: 767px) {
        .table-container {
            padding: 10px;
        }

        table.dataTable thead th, table.dataTable tbody td {
            padding: 10px;
            font-size: 14px;
        }

        .dataTables_wrapper {
            padding: 10px;
        }
    }
    </style>
</head>
<body>
<div class="container-scroller">
    <!-- Navbar -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row shadow-sm">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo mr-5" href="{{ url('/') }}">
                <img src="{{ asset('images/Logo_Bio_Farma.png') }}" style="width: 65%; height: 65%;" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
                <img src="{{ asset('images/logobiofarmakecil.png') }}" alt="logo" />
            </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
            <div class="nav-item dropdown">
                <span class="text-black font-weight-bold">{{ Auth::user()->name }}</span>
                <a class="nav-link p-0" href="#" data-toggle="dropdown" id="profileDropdown">
                    <div class="ms-1 d-flex justify-content-center">
                        <svg class="fill-current text-black" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    {{-- <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a> --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('dashboard') }}">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.notification') }}">
                        <i class="ti-bell menu-icon"></i>
                        <span class="menu-title">Notification</span>
                        @if($unreadNotificationsCount > 0)
                            <span class="badge badge-danger">{{ $unreadNotificationsCount }}</span>
                        @endif
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
                            <li class="nav-item"><a class="nav-link" href="{{ url('orderform') }}">Order Forms</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('orderhistory') }}">Offline History</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('online-history') }}">Online History</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                        <i class="icon-grid-2 menu-icon"></i>
                        <span class="menu-title">Data Collecting</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{ url('stok') }}">Data Table</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-panel">
            <div class="content-wrapper">
                <!-- Card Container -->
                <div class="card-container">
                    <!-- Row 1 -->
                    <div class="card-row-1">
                        <div class="card bg-primary text-white text-center shadow p-6 rounded shadow-md w-60">
                            <div class="card-body">
                                <p class="mb-2">Online Orders Today</p>
                                <h4 id="onlineOrdersToday">0</h4>
                            </div>
                        </div>

                        <div class="card bg-danger text-white text-center shadow p-6 rounded shadow-md w-60">
                            <div class="card-body">
                                <p class="mb-2">Offline Orders Today</p>
                                <h4 id="offlineOrdersToday">0</h4>
                            </div>
                        </div>

                        <div class="card bg-success text-white text-center shadow p-6 rounded shadow-md w-60">
                            <div class="card-body">
                                <p class="mb-2">Revenue Today</p>
                                <h4 id="totalRevenueToday">Rp 0</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="card-row-2">
                        <div class="card bg-warning text-white text-center shadow p-6 rounded shadow-md w-60">
                            <div class="card-body">
                                <p class="mb-2">Male Quantity Sold Today</p>
                                <h4 id="totalMaleSoldToday">0</h4>
                            </div>
                        </div>

                        <div class="card bg-warning text-white text-center shadow p-6 rounded shadow-md w-60    ">
                            <div class="card-body">
                                <p class="mb-2">Female Quantity Sold Today</p>
                                <h4 id="totalFemaleSoldToday">0</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Monthly Recap Table -->
                <div class="row table-container">
                    <div class="col-12">
                        <div class="card shadow-lg border-radius-2xl p-3">
                            <h4 class="card-title text-center font-weight-bold mb-4">Monthly Recap</h4>
                            <div class="table-responsive">
                                <table id="monthlyRecapTable" class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Total Orders</th>
                                            <th>Total Revenue</th>
                                            <th>Male Quantity Sold</th>
                                            <th>Female Quantity Sold</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data akan dimuat melalui DataTables -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024, Biofarma. STAS-RG. All rights reserved.</span>
                </div>
            </footer>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- Include Notification Script -->
{{-- @include('partials.notification-script') --}}
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Inisialisasi Pusher
    const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
    cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
    encrypted: true,
});

    // Subscribe ke channel
    const channel = pusher.subscribe('orders');

    // CSS untuk notifikasi
    const style = document.createElement('style');
    style.textContent = `
        .notification-container {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #28a745;
            color: white;
            padding: 15px 25px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 9000;
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.3s ease-in-out;
            max-width: 350px;
            word-wrap: break-word;
        }

        .notification-container.show {
            opacity: 1;
            transform: translateY(0);
        }

        .notification-container.hide {
            opacity: 0;
            transform: translateY(-20px);
        }
    `;
    document.head.appendChild(style);

    // Dengarkan event 'order.created'
    channel.bind('order.created', function(data) {
        // Buat container notifikasi
        const notificationContainer = document.createElement('div');
        notificationContainer.classList.add('notification-container');
        notificationContainer.textContent = `Pesanan baru dari ${data.order.fullname} untuk ${data.order.item_name}`;
        document.body.appendChild(notificationContainer);

        // Animasi munculnya notifikasi
        setTimeout(() => {
            notificationContainer.classList.add('show');
        }, 100);

        // Hilangkan notifikasi setelah 5 detik
        setTimeout(() => {
            notificationContainer.classList.add('hide');
            setTimeout(() => {
                notificationContainer.remove();
            }, 300);
        }, 5000);

        // Update badge notifikasi
        let badge = document.querySelector('.nav-link .badge');
        if (badge) {
            let currentCount = parseInt(badge.textContent);
            badge.textContent = currentCount + 1;
        } else {
            badge = document.createElement('span');
            badge.classList.add('badge', 'badge-danger');
            badge.textContent = 1;
            document.querySelector('.nav-link').appendChild(badge);
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        fetch('{{ route('dashboard.data') }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('onlineOrdersToday').innerText = data.onlineOrdersToday;
                document.getElementById('offlineOrdersToday').innerText = data.offlineOrdersToday;
                document.getElementById('totalRevenueToday').innerText = `Rp ${data.totalRevenueToday.toLocaleString('id-ID')}`;
                document.getElementById('totalMaleSoldToday').innerText = data.totalMaleSoldToday;
                document.getElementById('totalFemaleSoldToday').innerText = data.totalFemaleSoldToday;            })
            .catch(error => console.error('Error:', error));

        $(document).ready(function () {
            $('#monthlyRecapTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('monthly.recap.data') }}',
                columns: [
                    { data: 'month', name: 'month' },
                    { data: 'total_orders', name: 'total_orders' },
                    { data: 'total_revenue', name: 'total_revenue' },
                    { data: 'total_male_sold', name: 'total_male_sold' },
                    { data: 'total_female_sold', name: 'total_female_sold' },
                ]
            });
        });
    });
    
</script>

</body>
</html>
