<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Collecting</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
      .summary-item {
            display: grid;
            grid-template-columns: 200px auto; /* Lebar 200px untuk kolom label dan sisanya untuk nilai */
            align-items: center;
            gap: 10px; /* Spasi antara label dan nilai */
        }

        .summary-item strong {
            text-align: left; /* Agar teks label rata kanan */
        }
    body {
      font-family: 'Roboto', sans-serif;
  }

  h5 {
      font-weight: 400; 
      font-size: 16px;
      color: #333; 
  }

  .text-info {
      color: #007bff;
  }

  .text-success {
      color: #28a745;
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

                    <!-- Trigger Button with SVG Icon -->
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
                                    <li class="nav-item"> <a class="nav-link" href="{{ url('stok') }}">Data Table</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- Main Content -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <h4 class="mb-4">Data Collecting</h4>
                        <div class="card">
                          <div class="card-body">
                            <!-- Display Summary as Text in Two Columns -->
                            <div class="container mt-4">
                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <h5 class="summary-item"><strong>Male Sick:</strong> <span class="text-info male-sick-count">{{ $maleSickCount }}</span></h5>
                                  <h5 class="summary-item"><strong>Male Healthy (&lt;8g):</strong> <span class="text-success male-healthy-less-than-8">{{ $maleHealthyCounts['less_than_8'] }}</span></h5>
                                  <h5 class="summary-item"><strong>Male Healthy (8-14g):</strong> <span class="text-success male-healthy-between-8-and-14">{{ $maleHealthyCounts['between_8_and_14'] }}</span></h5>
                                  <h5 class="summary-item"><strong>Male Healthy (14-18g):</strong> <span class="text-success male-healthy-between-14-and-18">{{ $maleHealthyCounts['between_14_and_18'] }}</span></h5>
                                  <h5 class="summary-item"><strong>Male Healthy (&gt;18g):</strong> <span class="text-success male-healthy-greater-18">{{ $maleHealthyCounts['greater_equal_18'] }}</span></h5>
                              </div>
                              <div class="col-lg-6 mb-3">
                                  <h5 class="summary-item"><strong>Female Sick:</strong> <span class="text-info female-sick-count">{{ $femaleSickCount }}</span></h5>
                                  <h5 class="summary-item"><strong>Female Healthy (&lt;8g):</strong> <span class="text-success female-healthy-less-than-8">{{ $femaleHealthyCounts['less_than_8'] }}</span></h5>
                                  <h5 class="summary-item"><strong>Female Healthy (8-14g):</strong> <span class="text-success female-healthy-between-8-and-14">{{ $femaleHealthyCounts['between_8_and_14'] }}</span></h5>
                                  <h5 class="summary-item"><strong>Female Healthy (14-18g):</strong> <span class="text-success female-healthy-between-14-and-18">{{ $femaleHealthyCounts['between_14_and_18'] }}</span></h5>
                                  <h5 class="summary-item"><strong>Female Healthy (&gt;18g):</strong> <span class="text-success female-healthy-greater-18">{{ $femaleHealthyCounts['greater_equal_18'] }}</span></h5>
                              </div>
                              
                              </div>
                          </div>
                          
                        </div>
                        
                        <!-- Data Table -->
                        <div class="card">
                            <div class="card-body">
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

        <!-- DataTables Scripts -->
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

        <!-- Initialize DataTables -->
        <script type="text/javascript">
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
    // Delete action
    $('body').on('click', '.delete', function () {
        var id = $(this).data('id');
        if (confirm("Are you sure you want to delete this record?")) {
            $.ajax({
                url: `/detailmencit/delete/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    table.ajax.reload(); // Reload table after deletion
                    updateStockCounts();  // Update stock counts
                    alert('Record deleted successfully!');
                },
                error: function (response) {
                    alert('Failed to delete the record.');
                }
            });
        }
    });

    // Function to update stock counts
    function updateStockCounts() {
        $.ajax({
            url: "{{ route('detailmencit.updateStockCounts') }}", // Route to update stock counts
            type: 'GET',
            success: function (data) {
                // Update Male Stock Counts
                $('.male-sick-count').text(data.maleSickCount);
                $('.male-healthy-less-than-8').text(data.maleHealthyCounts.less_than_8);
                $('.male-healthy-between-8-and-14').text(data.maleHealthyCounts.between_8_and_14);
                $('.male-healthy-between-14-and-18').text(data.maleHealthyCounts.between_14_and_18);
                $('.male-healthy-greater-18').text(data.maleHealthyCounts.greater_equal_18);

                // Update Female Stock Counts
                $('.female-sick-count').text(data.femaleSickCount);
                $('.female-healthy-less-than-8').text(data.femaleHealthyCounts.less_than_8);
                $('.female-healthy-between-8-and-14').text(data.femaleHealthyCounts.between_8_and_14);
                $('.female-healthy-between-14-and-18').text(data.femaleHealthyCounts.between_14_and_18);
                $('.female-healthy-greater-18').text(data.femaleHealthyCounts.greater_equal_18);

                $('.yajra-datatable').DataTable().ajax.reload();
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
