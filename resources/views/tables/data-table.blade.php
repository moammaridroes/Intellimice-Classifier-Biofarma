    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Collecting</title>

        <!-- Plugins: CSS -->
        <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
        <!-- Inject:css -->
        <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
        <!-- End inject -->
        <link rel="shortcut icon" href="{{ asset('images/logobiofarmakecil.png') }}" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <style>
            .custom-swal-icon {
                margin-top: 30px; /* Adjust this to move the icon down */
            }
            .custom-swal-popup {
                padding-top: 40px; /* Adjust to increase spacing between title and icon */
            }
            .summary-item {
                display: grid;
                grid-template-columns: 200px auto;
                align-items: center;
                gap: 10px;
            }

            .summary-item strong {
                text-align: left;
            }

            body {
                font-family: 'Roboto', sans-serif;
            }

            h5 {
                font-weight: 400;
                font-size: 16px;
                color: #333;
            }

            .summary-container {
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 5px;
                margin-bottom: 10px;
            }
            .card-custom {
                border: none;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .card-custom.red {
                background-color: #e74c3c; /* Warna merah */
            }
            .card-custom.blue {
                background-color: #3498db; /* Warna biru */
            }
            .card-custom.pink {
                background-color: #e91e63; /* Warna pink */
            }
            .card-title {
                font-size: 1.5rem;
                margin: 0;
            }
            .card-text {
                font-size: 1rem;
                margin: 0;
            }
        </style>
    </head>

    <body>
        <div class="container-scroller">
            <!-- Navbar -->
            @include('partials.navbarAdmin')

            <!-- sidebar -->
            @include('partials.sidebarAdmin')

                    <!-- Main Panel -->
                    <div class="main-panel">
                        <div class="content-wrapper">
                            <h4 class="mb-4">Data Collecting</h4>

                            <!-- Summary Section -->
                            <div class="row d-flex justify-content-center flex-wrap">
                                <!-- Kartu Mice Sick -->
                                <div class="col-md-3 col-6 mb-4">
                                    <div class="card card-custom red">
                                        <div class="card-body">
                                            <h6 class="card-title text-center text-white mice-sick-count">{{ $miceSickCount }}</h6>
                                            <p class="card-text text-center text-white">Mice Sick</p>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Kartu Male Healthy -->
                                @foreach ($maleHealthyCounts as $key => $count)
                                @php
                                    // Escape simbol agar aman digunakan sebagai class
                                    $safeKey = preg_replace('[<>]', '', $key);
                                    $classKey = str_replace(['<', '>'], ['less-', 'greater-'], $key);
                                @endphp
                            
                                <div class="col-md-3 col-6 mb-4">
                                    <div class="card card-custom blue">
                                        <div class="card-body">
                                            <h6 class="card-title text-center text-white male-healthy-{{ $classKey }}">{{ $count }}</h6>
                                            <p class="card-text text-center text-white">Male Healthy ({{ $categories[$key] }})</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            @foreach ($femaleHealthyCounts as $key => $count)
                                @php
                                    $safeKey = preg_replace('[<>]', '', $key);
                                    $classKey = str_replace(['<', '>'], ['less-', 'greater-'], $key);
                                @endphp
                            
                                <div class="col-md-3 col-6 mb-4">
                                    <div class="card card-custom pink">
                                        <div class="card-body">
                                            <h6 class="card-title text-center text-white female-healthy-{{ $classKey }}">{{ $count }}</h6>
                                            <p class="card-text text-center text-white">Female Healthy ({{ $categories[$key] }})</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach                            
                            </div>
                            <!-- Data Table Section -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="container mt-4">
                                        <div class="container-fluid">
                                            <button id="deleteAll" class="btn btn-danger mb-4">Delete All</button>
                                            {{-- <button id="syncData" class="btn btn-primary mb-4">Sync Data</button> --}}
                                            <button id="toggleRefresh" class="btn btn-secondary mb-4">Enable Auto Refresh</button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped yajra-datatable">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>DATE</th>
                                                        <th>WEIGHT</th>
                                                        <th>GENDER</th>
                                                        <th>HEALTH STATUS</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Data will be populated by DataTables -->
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('partials.footer')
                    </div>
                </div>
            </div>

            <!-- Plugins:JS -->
            <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
            <!-- End inject -->
            <!-- Inject:JS -->
            <script src="{{ asset('js/off-canvas.js') }}"></script>
            <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
            <script src="{{ asset('js/template.js') }}"></script>
            <script src="{{ asset('js/settings.js') }}"></script>
            <script src="{{ asset('js/todolist.js') }}"></script>
            <!-- End inject -->

            <!-- DataTables Scripts -->
            <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            @include('partials.pusher')
            <script>               
                
                $(document).ready(function () {
                    var table = $('.yajra-datatable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('detailmencit.data') }}",
                        
                        // order: [[1, 'desc']],
                        columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'berat', name: 'berat' },
                        { data: 'gender', name: 'gender' },
                        { data: 'health_status', name: 'health_status' },
                        {
                            data: null,
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row) {
                                return `<button class="btn btn-danger btn-sm delete" data-id="${row.id}">Delete</button>`;
                            }
                        }
                    ]
                });
                    // Variabel untuk menyimpan interval ID
                        var refreshInterval = null;

                    // Fungsi untuk mengaktifkan interval
                    function startAutoRefresh() {
                        refreshInterval = setInterval(function () {
                            table.ajax.reload(null, false); // Reload data tanpa reset pagination
                        }, 5000); // Interval 5 detik
                        $('#toggleRefresh').text('Disable Auto Refresh').removeClass('btn-secondary').addClass('btn-success');
                    }

                    // Fungsi untuk menonaktifkan interval
                    function stopAutoRefresh() {
                        clearInterval(refreshInterval);
                        refreshInterval = null;
                        $('#toggleRefresh').text('Enable Auto Refresh').removeClass('btn-success').addClass('btn-secondary');
                    }

                    // Event listener untuk tombol "Toggle Refresh"
                    $('#toggleRefresh').click(function () {
                        if (refreshInterval) {
                            stopAutoRefresh();
                        } else {
                            startAutoRefresh();
                        }
                    });


                    $('#syncData').click(function () {
                    Swal.fire({
                        title: "Sync Data?",
                        text: "Apakah Anda yakin ingin menyinkronkan data?",
                        icon: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, sync it!",
                        customClass: {
                                popup: 'custom-swal-popup', 
                                icon: 'custom-swal-icon' 
                            }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/sync-detail-mencit', // Sesuaikan route untuk syncData
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function (response) {
                                    Swal.fire({
                                        title: 'Synced!',
                                        text: 'Data berhasil disinkronkan.',
                                        icon: 'success',
                                        customClass: {
                                            popup: 'custom-swal-popup', 
                                            icon: 'custom-swal-icon'
                                        }
                                });
                                    table.ajax.reload(); // Reload tabel setelah sinkronisasi
                                },
                                error: function (response) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Gagal menyinkronkan data.',
                                        icon: 'error',
                                        customClass: {
                                            popup: 'custom-swal-popup', 
                                            icon: 'custom-swal-icon'
                                        }
                                });
                                }
                            });
                        }
                    });
                });

                    // Delete all records with SweetAlert confirmation
                    $('#deleteAll').click(function () {
                        Swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#4B49AC",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete all!",
                            customClass: {
                                popup: 'custom-swal-popup', 
                                icon: 'custom-swal-icon'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '/detailmencit/deleteAll',
                                    type: 'DELETE',
                                    data: {
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function (response) {
                                        table.ajax.reload();
                                        updateStockCounts();
                                        Swal.fire({
                                            title: "Deleted!",
                                            text: "All records have been deleted.",
                                            icon: "success",
                                            customClass: {
                                                popup: 'custom-swal-popup', 
                                                icon: 'custom-swal-icon'
                                            }
                                        });
                                    },
                                    error: function (response) {
                                        Swal.fire({
                                            title: "Error!",
                                            text: "Failed to delete all records.",
                                            icon: "error",
                                            customClass: {
                                                popup: 'custom-swal-popup', 
                                                icon: 'custom-swal-icon' 
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    });

                    // Delete individual record with SweetAlert confirmation
                    $('body').on('click', '.delete', function () {
                        var id = $(this).data('id');
                        
                        Swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#4B49AC",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!",
                            customClass: {
                                popup: 'custom-swal-popup', 
                                icon: 'custom-swal-icon' 
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: `/detailmencit/delete/${id}`,
                                    type: 'DELETE',
                                    data: {
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function (response) {
                                        table.ajax.reload();
                                        updateStockCounts();
                                        Swal.fire({
                                            title: "Deleted!",
                                            text: "The record has been deleted.",
                                            icon: "success",
                                            customClass: {
                                                popup: 'custom-swal-popup', 
                                                icon: 'custom-swal-icon' 
                                            }
                                        });
                                    },
                                    error: function (response) {
                                        Swal.fire({
                                            title: "Error!",
                                            text: "Failed to delete the record.",
                                            icon: "error",
                                            customClass: {
                                                popup: 'custom-swal-popup', 
                                                icon: 'custom-swal-icon' 
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    });
                    // Function to update stock counts
                    // Reload table when categories change
                    // Update stock counts dynamically
                    function updateStockCounts() {
                        $.ajax({
                            url: "{{ route('detailmencit.updateStockCounts') }}",
                            type: 'GET',
                            success: function (data) {
                                $('.mice-sick-count').text(data.miceSickCount);

                                // Loop untuk meng-update Male Healthy Counts
                                Object.keys(data.maleHealthyCounts).forEach(function (key) {
                                    var safeKey = key.replace('<', 'less-').replace('>', 'greater-');
                                    $('.male-healthy-' + safeKey).text(data.maleHealthyCounts[key] || 0);
                                });

                                // Loop untuk meng-update Female Healthy Counts
                                Object.keys(data.femaleHealthyCounts).forEach(function (key) {
                                    var safeKey = key.replace('<', 'less-').replace('>', 'greater-');
                                    $('.female-healthy-' + safeKey).text(data.femaleHealthyCounts[key] || 0);
                                });
                            },
                            error: function () {
                                alert('Failed to update stock counts.');
                            }
                        });
                    }

                });
            </script>
        </body>
    </html>
