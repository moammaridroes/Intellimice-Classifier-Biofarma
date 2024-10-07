<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Order History</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/logobiofarmakecil.png') }}" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS for responsive table -->
    <style>
        .dataTables_wrapper {
            padding: 20px;
        }
        .table-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .yajra-datatable {
            width: 100% !important;
            border-collapse: separate;
            border-spacing: 0;
        }
        .yajra-datatable thead th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 15px;
            border-bottom: 2px solid #dee2e6;
        }
        .yajra-datatable tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
        }
        .yajra-datatable tbody tr:last-child td {
            border-bottom: none;
        }
        .yajra-datatable tbody tr:hover {
            background-color: #f1f3f5;
        }
        .dataTables_info, .dataTables_paginate {
            margin-top: 15px;
        }
        .dataTables_filter input, .dataTables_length select {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 5px 10px;
        }
        .dataTables_filter input:focus, .dataTables_length select:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }
        .details-button, .edit-button, .delete-button {
            cursor: pointer;
            color: #4B49AC;
            font-size: 1.2em;
        }
        .details-button:hover, .edit-button:hover, .delete-button:hover {
            color: #0056b3;
        }
        /* Media Queries */
        @media (max-width: 768px) {
            .table-responsive {
                border: none;
                overflow-x: auto;
            }
            .yajra-datatable tbody td {
                font-size: 12px;
                padding: 8px;
            }
            .yajra-datatable thead th {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:_navbar.blade.php -->
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

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:_sidebar.blade.php -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('notification') }}">
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
                                <li class="nav-item"><a class="nav-link" href="{{ url('orderform') }}">Order Forms</a></li>
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ url('orderhistory') }}">Offline History</a></li>
                            </ul>
                            <ul class="nav flex-column sub-menu">
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
                                <li class="nav-item"> <a class="nav-link" href="{{ url('stok') }}">Data Table</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <h4 class="card-title mb-4">Offline Order History</h4>
                    <div class="card">
                        <div class="card-body">
                            <!-- Tampilkan pesan sukses -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <!-- Tabel data order menggunakan Yajra DataTables -->
                            <div class="table-container">
                                <div class="table-responsive"> <!-- Membuat tabel responsif -->
                                    <table class="table table-striped yajra-datatable">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Fullname</th>
                                                <th>Phone Number</th>
                                                <th>Item Name</th>
                                                <th>Details</th>
                                                <th>Action</th> <!-- Kolom Action untuk Edit/Delete -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data akan diisi dari Yajra DataTables -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:_footer.blade.php -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024, Biofarma. STAS-RG. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- Modal untuk menampilkan detail order -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Detail order akan dimasukkan secara dinamis di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk mengedit order -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form edit order akan dimasukkan secara dinamis di sini -->
                    <form id="editForm">
                        @csrf
                        <div class="form-group">
                            <label for="edit_fullname">Fullname</label>
                            <input type="text" class="form-control" id="edit_fullname" name="fullname" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_phone_number">Phone Number</label>
                            <input type="text" class="form-control" id="edit_phone_number" name="phone_number" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_item_name">Item Name</label>
                            <input type="text" class="form-control" id="edit_item_name" name="item_name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_item_name">Agency Name</label>
                            <input type="text" class="form-control" id="edit_agency_name" name="agency_name" required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="edit_item_name">Weight</label>
                            <input type="text" class="form-control" id="edit_weight" name="weight" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_item_name">Male Quantity</label>
                            <input type="text" class="form-control" id="edit_male_quantity" name="male_quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_item_name">Female Quantity</label>
                            <input type="text" class="form-control" id="edit_female_quantity" name="female_quantity" required>
                        </div> --}}
                        <button type="button" class="btn btn-primary" style="background-color: #4B49AC; border-color: #4B49AC;" id="updateOrderButton">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

    <!-- jQuery dan DataTables scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables Bootstrap 5 integration -->
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <!-- Moment.js untuk format tanggal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script type="text/javascript">
        $(function () {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('orderhistory.getData') }}",
                columns: [
                    {
                        data: 'created_at',
                        name: 'created_at',
                        // render: function (data, type, row) {
                        //     return moment(data).format('YYYY-MM-DD HH:mm:ss'); // Format tanggal sesuai kebutuhan
                        // }
                    },
                    {data: 'fullname', name: 'fullname'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'item_name', name: 'item_name'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return '<button class="btn btn-link details-button" data-bs-toggle="modal" data-bs-target="#detailsModal" data-details="' + encodeURIComponent(JSON.stringify(row)) + '"><i class="fas fa-eye"></i></button>';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return `
                                <button class="btn btn-link edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-link delete-button" data-id="${row.id}"><i class="fas fa-trash"></i></button>
                            `;
                        }
                    }
                ],
                order: [[0, 'desc']], // Urutkan berdasarkan kolom created_at (index 0)
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                pageLength: 5,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                },
                drawCallback: function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                }
            });

            // Handle click on details button
            $('.yajra-datatable').on('click', '.details-button', function () {
                var data = JSON.parse(decodeURIComponent($(this).data('details')));
                var modalBody = $('#detailsModal .modal-body');
                modalBody.empty();

                var table = $('<table class="table table-sm table-bordered"></table>');
                var tbody = $('<tbody></tbody>');
                table.append(tbody);

                tbody.append('<tr><th>Date</th><td>' + data.created_at + '</td></tr>');
                tbody.append('<tr><th>Fullname</th><td>' + data.fullname + '</td></tr>');
                tbody.append('<tr><th>Phone Number</th><td>' + data.phone_number + '</td></tr>');
                tbody.append('<tr><th>Email</th><td>' + data.email + '</td></tr>');
                tbody.append('<tr><th>Item Name</th><td>' + data.item_name + '</td></tr>');
                tbody.append('<tr><th>Agency Name</th><td>' + data.agency_name + '</td></tr>');
                tbody.append('<tr><th>Operator Name</th><td>' + data.operator_name + '</td></tr>');
                tbody.append('<tr><th>Weight</th><td>' + data.weight + '</td></tr>');
                tbody.append('<tr><th>Male Quantity</th><td>' + data.male_quantity + '</td></tr>');
                tbody.append('<tr><th>Female Quantity</th><td>' + data.female_quantity + '</td></tr>');
                tbody.append('<tr><th>Total Price</th><td>Rp ' + (data.total_price ? new Intl.NumberFormat('id-ID').format(data.total_price) : '0') + '</td></tr>');
                tbody.append('<tr><th>Payment Status</th><td>' + (data.is_paid ? 'Paid' : 'Unpaid') + '</td></tr>');
                modalBody.append(table);
            });       
                 // Handle click on edit button
            $('.yajra-datatable').on('click', '.edit-button', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: `{{ url('orderhistory/edit') }}/${id}`,
                    type: 'GET',
                    success: function(data) {
                        var form = $('#editForm');
                        form.find('#edit_fullname').val(data.fullname);
                        form.find('#edit_phone_number').val(data.phone_number);
                        form.find('#edit_email').val(data.email);
                        form.find('#edit_item_name').val(data.item_name);
                        form.find('#edit_agency_name').val(data.agency_name);
                        // form.find('#edit_weight').val(data.weight);
                        // form.find('#edit_male_quantity').val(data.male_quantity);
                        // form.find('#edit_female_quantity').val(data.female_quantity);
                        $('#updateOrderButton').data('id', id); // Set id to update button
                    }
                });
            });

            // update button click
            $('#updateOrderButton').on('click', function() {
                var id = $(this).data('id');
                var formData = $('#editForm').serialize();
                $.ajax({
                    url: `{{ url('orderhistory/update') }}/${id}`,
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        $('#editModal').modal('hide');
                        table.ajax.reload();
                    }
                });
            });

            // delete button click
            $('.yajra-datatable').on('click', '.delete-button', function () {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this order?')) {
                    $.ajax({
                        url: `{{ url('orderhistory/delete') }}/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}" // Kirim CSRF token untuk permintaan penghapusan
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Order deleted successfully');
                                // Reload DataTable untuk memperbarui data
                                $('.yajra-datatable').DataTable().ajax.reload();
                            } else {
                                alert('Failed to delete order');
                            }
                        },
                        error: function(xhr) {
                            alert('Error: ' + xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
