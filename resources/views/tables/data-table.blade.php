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
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <h5 class="summary-item"><strong>Mice Sick</strong> <span class="text-danger mice-sick-count">: {{ $miceSickCount }}</span></h5>
                                        <h5 class="summary-item"><strong>Male Healthy (&lt;10g)</strong> <span class="text-success male-healthy-less-than-8">: {{ $maleHealthyCounts['category1'] }}</span></h5>
                                        <h5 class="summary-item"><strong>Male Healthy (10-22g)</strong> <span class="text-success male-healthy-between-8-and-14">: {{ $maleHealthyCounts['category2'] }}</span></h5>
                                        {{-- <h5 class="summary-item"><strong>Male Healthy (14-18g)</strong> <span class="text-success male-healthy-between-14-and-18">: {{ $maleHealthyCounts['category3'] }}</span></h5> --}}
                                        <h5 class="summary-item"><strong>Male Healthy (&gt;22g)</strong> <span class="text-success male-healthy-greater-18">: {{ $maleHealthyCounts['category3'] }}</span></h5>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        {{-- <h5 class="summary-item"><strong>Female Sick:</strong> <span class="text-danger female-sick-count">{{ $femaleSickCount }}</span></h5> --}}
                                        <h5 class="summary-item"><strong>Female Healthy (&lt;10g)</strong> <span class="text-success female-healthy-less-than-8">: {{ $femaleHealthyCounts['category1'] }}</span></h5>
                                        <h5 class="summary-item"><strong>Female Healthy (10-22g)</strong> <span class="text-success female-healthy-between-8-and-14">: {{ $femaleHealthyCounts['category2'] }}</span></h5>
                                        {{-- <h5 class="summary-item"><strong>Female Healthy (14-18g)</strong> <span class="text-success female-healthy-between-14-and-18">: {{ $femaleHealthyCounts['category3'] }}</span></h5> --}}
                                        <h5 class="summary-item"><strong>Female Healthy (&gt;22g)</strong> <span class="text-success female-healthy-greater-18">: {{ $femaleHealthyCounts['category3'] }}</span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Table Section -->
                        <div class="card">
                            <div class="card-body">
                                <div class="container mt-4">
                                    <div class="container-fluid">
                                        <button id="deleteAll" class="btn btn-danger mb-4">Delete All</button>
                                        <button id="syncData" class="btn btn-primary mb-4">Sync Data</button>
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
                                                {{-- @foreach($dataMencit as $key => $mencit)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($mencit->created_at)->format('d/m/Y') }}</td>
                                                        <td>{{ $mencit->berat ?? 'N/A' }}</td>
                                                        <td>{{ $mencit->gender ?? 'N/A' }}</td>
                                                        <td>
                                                            @if($mencit->health_status == 'Healthy')
                                                                <label class="badge badge-success">Healthy</label>
                                                            @elseif($mencit->health_status == 'Sick')
                                                                <label class="badge badge-danger">Sick</label>
                                                            @else
                                                                <label class="badge badge-warning">N/A</label>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach --}}
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
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row) {
                                return `<button class="btn btn-danger btn-sm delete" data-id="${row.id}">Delete</button>`;
                            }
                        }
                    ]
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
                function updateStockCounts() {
                    $.ajax({
                        url: "{{ route('detailmencit.updateStockCounts') }}",
                        type: 'GET',
                        success: function (data) {
                            // Update Male Stock Counts
                            $('.mice-sick-count').text(data.miceSickCount);
                            $('.male-healthy-less-than-8').text(data.maleHealthyCounts.category1);
                            $('.male-healthy-between-8-and-14').text(data.maleHealthyCounts.category2);
                            // $('.male-healthy-between-14-and-18').text(data.maleHealthyCounts.category3);
                            $('.male-healthy-greater-18').text(data.maleHealthyCounts.category3);

                            // Update Female Stock Counts
                            // $('.female-sick-count').text(data.femaleSickCount);
                            $('.female-healthy-less-than-8').text(data.femaleHealthyCounts.category1);
                            $('.female-healthy-between-8-and-14').text(data.femaleHealthyCounts.category2);
                            // $('.female-healthy-between-14-and-18').text(data.femaleHealthyCounts.category3);
                            $('.female-healthy-greater-18').text(data.femaleHealthyCounts.category3);

                            table.ajax.reload();
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
