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
    {{-- navbar --}}
    @include('partials.navbarAdmin')

    <!-- Sidebar -->
    @include('partials.sidebarAdmin')

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
            @include('partials.footer')
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('partials.pusher')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('{{ route('dashboard.data') }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('onlineOrdersToday').innerText = data.onlineOrdersToday;
                document.getElementById('offlineOrdersToday').innerText = data.offlineOrdersToday;
                document.getElementById('totalRevenueToday').innerText = `Rp ${data.totalRevenueToday.toLocaleString('id-ID')}`;
                document.getElementById('totalMaleSoldToday').innerText = data.totalMaleSoldToday;
                document.getElementById('totalFemaleSoldToday').innerText = data.totalFemaleSoldToday;            
            })
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
