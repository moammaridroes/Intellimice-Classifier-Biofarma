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

                <div class="nav-item dropdown">
                    <span class="text-black font-weight-bold">
                        {{ Auth::user()->name }}
                    </span>

                    <a class="nav-link p-0" href="#" data-toggle="dropdown" id="profileDropdown">
                        <div class="ms-1 d-flex justify-content-center">
                            <svg class="fill-current text-black" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
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

        <!-- Main Content -->
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper">
                <!-- Sidebar -->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('dashboard') }}">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.notification') }}" >
                                <i class="ti-bell menu-icon position-relative"></i>
                                <span class="menu-title">Notification</span>
                                <span id="notificationBadge" class="badge badge-danger notification-badge">{{ $unreadNotificationsCount > 0 ? $unreadNotificationsCount : '' }}</span>
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

                <!-- Main Panel -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <h4 class="mb-4">Data Collecting</h4>

                        <!-- Summary Section -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <h5 class="summary-item"><strong>Mice Sick:</strong> <span class="text-danger mice-sick-count">{{ $miceSickCount }}</span></h5>
                                        <h5 class="summary-item"><strong>Male Healthy (&lt;8g):</strong> <span class="text-success male-healthy-less-than-8">{{ $maleHealthyCounts['category1'] }}</span></h5>
                                        <h5 class="summary-item"><strong>Male Healthy (8-14g):</strong> <span class="text-success male-healthy-between-8-and-14">{{ $maleHealthyCounts['category2'] }}</span></h5>
                                        <h5 class="summary-item"><strong>Male Healthy (14-18g):</strong> <span class="text-success male-healthy-between-14-and-18">{{ $maleHealthyCounts['category3'] }}</span></h5>
                                        <h5 class="summary-item"><strong>Male Healthy (&gt;18g):</strong> <span class="text-success male-healthy-greater-18">{{ $maleHealthyCounts['category4'] }}</span></h5>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        {{-- <h5 class="summary-item"><strong>Female Sick:</strong> <span class="text-danger female-sick-count">{{ $femaleSickCount }}</span></h5> --}}
                                        <h5 class="summary-item"><strong>Female Healthy (&lt;8g):</strong> <span class="text-success female-healthy-less-than-8">{{ $femaleHealthyCounts['category1'] }}</span></h5>
                                        <h5 class="summary-item"><strong>Female Healthy (8-14g):</strong> <span class="text-success female-healthy-between-8-and-14">{{ $femaleHealthyCounts['category2'] }}</span></h5>
                                        <h5 class="summary-item"><strong>Female Healthy (14-18g):</strong> <span class="text-success female-healthy-between-14-and-18">{{ $femaleHealthyCounts['category3'] }}</span></h5>
                                        <h5 class="summary-item"><strong>Female Healthy (&gt;18g):</strong> <span class="text-success female-healthy-greater-18">{{ $femaleHealthyCounts['category4'] }}</span></h5>
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
                notificationContainer.textContent = `New orders have been received`;
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
                const badge = document.getElementById('notificationBadge');
                if (badge) {
                    // Ambil nilai badge saat ini dan ubah ke angka (0 jika kosong)
                    let currentCount = parseInt(badge.textContent) || 0;
                        
                    // Tambahkan 1 ke nilai saat ini
                    badge.textContent = currentCount + 1;
                }
            });
            
            
            $(document).ready(function () {
                var table = $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('detailmencit.data') }}",
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
                            $('.male-healthy-between-14-and-18').text(data.maleHealthyCounts.category3);
                            $('.male-healthy-greater-18').text(data.maleHealthyCounts.category4);

                            // Update Female Stock Counts
                            // $('.female-sick-count').text(data.femaleSickCount);
                            $('.female-healthy-less-than-8').text(data.femaleHealthyCounts.category1);
                            $('.female-healthy-between-8-and-14').text(data.femaleHealthyCounts.category2);
                            $('.female-healthy-between-14-and-18').text(data.femaleHealthyCounts.category3);
                            $('.female-healthy-greater-18').text(data.femaleHealthyCounts.category4);

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
