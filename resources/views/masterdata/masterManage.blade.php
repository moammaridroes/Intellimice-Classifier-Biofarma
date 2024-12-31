<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Home</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/logobiofarmakecil.png') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<style>
    .custom-swal-icon {
        margin-top: 20px; /* Adjust this to move the icon down */
    }
    .custom-swal-popup {
        padding-top: 40px; /* Adjust to increase spacing between title and icon */
    }
    .card-custom {
    border-radius: 10px;
    box-shadow: 0px 4px 6px rgba(253, 253, 253, 0.1);
    transition: all 0.3s ease;
    color: white;
    text-align: center;
    }
    .card-custom.pink {
      background: linear-gradient(45deg, #ff69b4, #ff33b5);
    }
    .card-custom.blue {
      background: linear-gradient(45deg, #2196f3, #03a9f4);
    }
    .card-custom.red {
      background: linear-gradient(45deg, #f44336, #e91e63);
    }
  
    body {
        background-color: #f4f5f7; /* Warna latar belakang lebih lembut */
        font-family: 'Roboto', sans-serif;
    }

    .card-custom {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        background: linear-gradient(45deg, #3f51b5, #5c6bc0); /* Warna gradien */
        color: white;
        text-align: center;
    }

    .card-custom:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .card-header {
        background-color: #4B49AC;
        color: white;
        font-weight: bold;
        border-radius: 10px 10px 0 0;
    }

    table.table-bordered {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    table th {
        background-color: #4B49AC;
        color: white;
        text-align: center;
    }

    table td {
        text-align: center;
        vertical-align: middle;
    }

    .btn-primary {
        background: linear-gradient(45deg, #4B49AC, #673AB7);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #673AB7, #4B49AC);
    }

    .btn-success {
        background: linear-gradient(45deg, #00C853, #64DD17);
        border: none;
    }

    .btn-success:hover {
        background: linear-gradient(45deg, #64DD17, #00C853);
    }

    .btn-danger {
        background: linear-gradient(45deg, #D50000, #FF1744);
        border: none;
    }

    .btn-danger:hover {
        background: linear-gradient(45deg, #FF1744, #D50000);
    }

    /* Responsiveness for smaller screens */
    @media (max-width: 768px) {
        .card-custom {
            margin-bottom: 20px;
        }

        table {
            font-size: 0.85em;
        }
    }
  </style>
  


<body>
    <div class="container-scroller">
        @include('partials.navbarAdmin')
        @include('partials.sidebarMaster')
        <!-- Main Content -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row d-flex justify-content-center flex-wrap">
                    <!-- Kartu Mencit Sakit -->
                    <div class="col-md-3 col-6 mb-4">
                        <div class="card card-custom red">
                            <div class="card-body">
                                <h6 class="card-title text-center" style="color: white">{{ $miceSickCount }}</h6>
                                <p class="card-text text-center">Mice Sick</p>
                            </div>
                        </div>
                    </div>
                
                    <!-- Loop untuk Mencit Jantan -->
                    @foreach ($weightCategories as $key => $label)
                    <div class="col-md-3 col-6 mb-4">
                        <div class="card card-custom blue">
                            <div class="card-body">
                                <h6 class="card-title text-center" style="color: white">{{ $maleHealthyCounts[$key] }}</h6>
                                <p class="card-text text-center">Male Healthy ({{ $label }})</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                
                    <!-- Loop untuk Mencit Betina -->
                    @foreach ($weightCategories as $key => $label)
                    <div class="col-md-3 col-6 mb-4">
                        <div class="card card-custom pink">
                            <div class="card-body">
                                <h6 class="card-title text-center" style="color: white">{{ $femaleHealthyCounts[$key] }}</h6>
                                <p class="card-text text-center">Female Healthy ({{ $label }})</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                

                <div class="card mt-5">
                    <div class="card-header">
                        <h5 class="text-center">Change Price</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('master.update.prices') }}" method="POST" onsubmit="return confirmUpdate(event)">
                            @csrf
                            <!-- Tambahkan pembungkus table-responsive -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gender</th>
                                            <th>Weight Category</th>
                                            <th>Current Price (Rp)</th>
                                            <th>New Price (Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $iteration = 1; @endphp
                                        @foreach (config('mice.prices') as $gender => $categories)
                                            @foreach ($categories as $category => $price)
                                                <tr>
                                                    @if ($loop->first) <!-- Hanya untuk baris pertama setiap gender -->
                                                    <td rowspan="{{ count($categories) }}">{{ $iteration++ }}</td>
                                                    @endif
                                                    <td>{{ ucfirst($gender) }}</td>
                                                    <td>{{ $category }}</td>
                                                    <td>{{ 'Rp. ' . number_format($price, 0, ',', '.') }}</td>
                                                    <td>
                                                        <input type="number" name="prices[{{ $gender }}][{{ $category }}]" value="{{ $price }}" class="form-control" required>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                
                
                <div class="card mt-5">
                    <div class="card-header">
                        <h5 class="text-center">Manage Weight Categories</h5>
                    </div>
                    <div class="card-body">
                        <!-- Tambah Kategori -->
                        <form action="{{ route('master.categories.store') }}" method="POST" onsubmit="return confirmAddCategory(event)">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label for="key">Category Key</label>
                                    <input type="text" name="key" id="key" class="form-control" placeholder="e.g., 10-20" required>
                                    @error('key')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="description">Category Description</label>
                                    <input type="text" name="description" id="description" class="form-control" placeholder="e.g., <10,10-20,>20" required>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-success w-100">Add Category</button>
                                </div>
                            </div>
                        </form>                        
                        <!-- Tabel Kategori Berat -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Key</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (config('mice.categories') as $key => $description)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <form action="{{ route('master.categories.update-key', ['key' => $key]) }}" method="POST" onsubmit="return confirmUpdateKey(event)" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="new_key" value="{{ $key }}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="description" value="{{ $description }}" class="form-control">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary btn-sm">Update Key</button>
                                            </form>
                                            <form action="{{ route('master.categories.destroy', ['key' => $key]) }}" method="POST" onsubmit="return confirmDeleteCategory(event)" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>                                            
                                        </td>
                                    </tr>                                    
                                    @endforeach
                                </tbody>
                            </table>
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
    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Success',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            customClass: {
            popup: 'custom-swal-popup', // Apply this class to the entire popup for layout adjustments
            icon: 'custom-swal-icon' // Adjust the icon specifically
        },
        });
    </script>
    @endif
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
  <!-- Chart.js Script -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    function confirmUpdate(event) {
    event.preventDefault(); // Mencegah pengiriman form secara langsung
    const form = event.target.closest('form'); 

    Swal.fire({
        title: 'Warning!',
        text: 'Are you sure you want to change the price?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, save changes!',
        customClass: {
            popup: 'custom-swal-popup', // Apply this class to the entire popup for layout adjustments
            icon: 'custom-swal-icon' // Adjust the icon specifically
        },
        cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed && form) {
                form.submit(); // Mengirim form jika tombol "Ya" ditekan
            }
        });
    }
     // Konfirmasi Tambah Kategori
     function confirmAddCategory(event) {
        event.preventDefault(); // Mencegah submit langsung
        const form = event.target;

        Swal.fire({
            title: 'Add Category',
            text: 'Are you sure you want to add this category?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Add it!',
            cancelButtonText: 'Cancel',
            customClass: {
            popup: 'custom-swal-popup', // Apply this class to the entire popup for layout adjustments
            icon: 'custom-swal-icon' // Adjust the icon specifically
        },
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Submit form jika dikonfirmasi
            }
        });
    }

    // Konfirmasi Update Key
    function confirmUpdateKey(event) {
        event.preventDefault(); // Mencegah submit langsung
        const form = event.target;

        Swal.fire({
            title: 'Update Key',
            text: 'Are you sure you want to update this key?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Update it!',
            cancelButtonText: 'Cancel',
            customClass: {
            popup: 'custom-swal-popup', // Apply this class to the entire popup for layout adjustments
            icon: 'custom-swal-icon' // Adjust the icon specifically
        },
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Submit form jika dikonfirmasi
            }
        });
    }

    // Konfirmasi Hapus Kategori
    function confirmDeleteCategory(event) {
        event.preventDefault(); // Mencegah submit langsung
        const form = event.target;

        Swal.fire({
            title: 'Delete Category',
            text: 'Are you sure you want to delete this category?',
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, Delete it!',
            cancelButtonText: 'Cancel',
            customClass: {
            popup: 'custom-swal-popup', // Apply this class to the entire popup for layout adjustments
            icon: 'custom-swal-icon' // Adjust the icon specifically
        },
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Submit form jika dikonfirmasi
            }
        });
    }
  </script>
  </body>
</html>
