<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>History</title>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        .badge {
        padding: 0.5em 0.75em;
        font-size: 0.875em;
        font-weight: 600;
        text-transform: uppercase;
        }

        .bg-success {
            background-color: #28a745 !important;
            color: white;
        }

        .bg-danger {
            background-color: #dc3545 !important;
            color: white;
        }
        .dataTables_wrapper {
            padding: 20px;
        }
        .modal-body p {
            word-wrap: break-word;
            white-space: pre-wrap; 
        }

        .table-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(140, 72, 72, 0.1);
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

        .dataTables_info,
        .dataTables_paginate {
            margin-top: 15px;
        }

        .dataTables_filter input,
        .dataTables_length select {
            border: 1px solid #4B49AC;
            border-radius: 4px;
            padding: 5px 10px;
        }

        .dataTables_filter input:focus,
        .dataTables_length select:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }

        .details-button {
            cursor: pointer;
            color: #4B49AC;
            font-size: 1.2em;
        }

        .details-button:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:_navbar.blade.php -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{ url('/customer/home') }}">
                    <img src="{{ asset('images/Logo_Bio_Farma.png') }}" style="width: 65%; height: 65%;" class="mr-2" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('/customer/home') }}">
                    <img src="{{ asset('images/logobiofarmakecil.png') }}" alt="logo" />
                </a>
            </div>

            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>

                <div class="nav-item dropdown">
                    <!-- Username Display -->
                    <span class="text-black font-weight-bold">
                        {{ Auth::user()->name }}
                    </span>

                    <!-- Trigger Button with SVG Icon -->
                    <a class="nav-link p-0" href="#" data-toggle="dropdown" id="profileDropdown">
                        <div class="ms-1 d-flex justify-content-center">
                            <!-- Custom Black SVG Icon -->
                            <svg class="fill-current text-black" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 011.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <!-- Profile Link -->
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            {{ __('Profile') }}
                        </a>

                        <!-- Logout Form -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>
        </nav>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:_settings-panel.blade.php -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                </div>
            </div>
            <!-- partial -->
            <!-- partial:_sidebar.blade.php -->
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
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ url('customer/history') }}">Order History</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <h4 class="card-title mb-4">Order History</h4>
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
                                <table class="table table-striped yajra-datatable">
                                    <thead>
                                        <tr>
                                            {{-- <th>Fullname</th>
                                            <th>Phone Number</th> --}}
                                            {{-- <th>Email</th> --}}
                                            <th>Item Name</th>
                                            <th>Pick Up Date</th>
                                            {{-- <th>Weight</th> --}}
                                            <th>Total Price</th>
                                            <th>Payment Status</th>
                                            <th>Status</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data akan diisi oleh Yajra DataTables -->
                                    </tbody>
                                </table>
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

    <!-- Detail Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Details will be inserted here dynamically -->
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- Tombol untuk mendownload detail order sebagai gambar -->
                {{-- <button type="button" class="btn btn-primary download-details">Download as Image</button> --}}
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

<!-- jQuery and DataTables scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables Bootstrap 5 integration -->
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- html2canvas for downloading images -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script type="text/javascript">
    $(function () {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('customer.history.getData') }}",
            order: [[0, 'desc']],
            columns: [
                { data: 'item_name', name: 'item_name' },
                { data: 'pick_up_date', name: 'pick_up_date' },
                { data: 'total_price', name: 'total_price', render: function(data) { return data && !isNaN(data) ? 'Rp ' + new Intl.NumberFormat('id-ID').format(data) : data; }},
                { 
                    data: 'is_paid',
                    name: 'is_paid',
                    render: function (data, type, row) {
                        var statusClass = data === 'Paid' ? 'badge bg-success' : 'badge bg-danger';
                        return '<span class="' + statusClass + '">' + data + '</span>';
                    }
                },
                { data: 'status', name: 'status' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `
                            <button class="btn btn-link details-button" data-bs-toggle="modal" data-bs-target="#detailsModal" data-details="${encodeURIComponent(JSON.stringify(row))}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-link download-button" style="color: #4B49AC" data-details="${encodeURIComponent(JSON.stringify(row))}">
                                <i class="fas fa-download"></i>
                            </button>
                        `;
                    }
                }
            ],
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            pageLength: 5,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            },
            drawCallback: function () {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });

        // Handle click on details button
        $('.yajra-datatable').on('click', '.details-button', function () {
            var data = JSON.parse(decodeURIComponent($(this).data('details')));
            var modalBody = $('#detailsModal .modal-body');
            modalBody.empty();
            modalBody.append('<p><strong>Fullname:</strong> ' + data.fullname + '</p>');
            modalBody.append('<p><strong>Phone Number:</strong> ' + data.phone_number + '</p>');
            modalBody.append('<p><strong>Email:</strong> ' + data.email + '</p>');
            modalBody.append('<p><strong>Item Name:</strong> ' + data.item_name + '</p>');
            modalBody.append('<p><strong>Pick Up Date:</strong> ' + data.pick_up_date + '</p>');
            modalBody.append('<p><strong>Weight:</strong> ' + data.weight + '</p>');
            modalBody.append('<p><strong>Male Quantity:</strong> ' + data.male_quantity + '</p>');
            modalBody.append('<p><strong>Female Quantity:</strong> ' + data.female_quantity + '</p>');
            modalBody.append('<p><strong>Total Price:</strong>  ' + data.total_price + '</p>');
            modalBody.append('<p><strong>Payment Status:</strong> ' + data.is_paid + '</p>');
            modalBody.append('<p><strong>Status:</strong> ' + data.status + '</p>');
            modalBody.append('<p><strong>Notes:</strong> ' + (data.notes ? data.notes : '-') + '</p>');
        });

        // Handle download details as PDF
        $('.yajra-datatable').on('click', '.download-button', function () {
            var data = JSON.parse(decodeURIComponent($(this).data('details')));

            // Buat instance jsPDF
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Set font style dan ukuran
            doc.setFont("Helvetica", "normal");
            doc.setFontSize(12);

            // Tambahkan judul untuk struk pembelian
            doc.setFontSize(16);
            doc.text("Receipt / Order Details", 105, 20, null, null, "center");
            doc.setFontSize(12);

            // Garis pemisah
            doc.line(10, 25, 200, 25);

            // Posisi label dan nilai
            let labelX = 20;
            let valueX = 80;
            let lineHeight = 10;
            let startY = 35;

            // Isi PDF dengan data order yang dirapikan
            doc.text("Fullname:", labelX, startY);
            doc.text(data.fullname, valueX, startY);

            startY += lineHeight;
            doc.text("Phone Number:", labelX, startY);
            doc.text(data.phone_number, valueX, startY);

            startY += lineHeight;
            doc.text("Email:", labelX, startY);
            doc.text(data.email, valueX, startY);

            startY += lineHeight;
            doc.text("Item Name:", labelX, startY);
            doc.text(data.item_name, valueX, startY);

            startY += lineHeight;
            doc.text("Pick Up Date:", labelX, startY);
            doc.text(data.pick_up_date.toString(), valueX, startY);

            startY += lineHeight;
            doc.text("Weight:", labelX, startY);
            doc.text(data.weight.toString() + " gr", valueX, startY);

            startY += lineHeight;
            doc.text("Male Quantity:", labelX, startY);
            doc.text(data.male_quantity.toString(), valueX, startY);

            startY += lineHeight;
            doc.text("Female Quantity:", labelX, startY);
            doc.text(data.female_quantity.toString(), valueX, startY);

            startY += lineHeight;
            doc.text("Total Price:", labelX, startY);
            doc.text(data.total_price.toString(), valueX, startY);

            startY += lineHeight;
            doc.text("Payment Status:", labelX, startY);
            doc.text(data.is_paid, valueX, startY);

            startY += lineHeight;
            doc.text("Status:", labelX, startY);
            doc.text(data.status, valueX, startY);

            startY += lineHeight;
            doc.text("Notes:", labelX, startY);
            // Cek apakah ada notes, jika ada, bagi teks menjadi beberapa baris
            if (data.notes && data.notes.length > 0) {
                // Split text untuk memastikan teks tidak melampaui batas lebar PDF
                var splitNotes = doc.splitTextToSize(data.notes.toString(), 110); // 110 menentukan lebar kolom untuk teks Notes
                doc.text(splitNotes, valueX, startY);  // Cetak teks notes dengan split
                startY += lineHeight * splitNotes.length;  // Adjust posisi Y berdasarkan jumlah baris notes
            } else {
                doc.text("-", valueX, startY);  // Jika tidak ada notes, tampilkan "-"
                startY += lineHeight;
            }
           // Garis pemisah untuk penutup
            doc.line(10, startY + 10, 200, startY + 10);

            // Tambahkan footer
            doc.setFontSize(10);
            doc.text("Thank you for your order!", 105, startY + 20, null, null, "center");
            doc.text("Biofarma STAS-RG", 105, startY + 25, null, null, "center");

            // Download file PDF
            doc.save(`order-details-${data.fullname}.pdf`);
        });
    });
</script>
</body>
</html>
