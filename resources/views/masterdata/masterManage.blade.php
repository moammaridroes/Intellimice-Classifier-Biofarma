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
    .card-custom.orange {
      background: linear-gradient(45deg, #ff9800, #ff5722);
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
  
    /* Table styles */
    table.table-bordered {
      background-color: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0px 5px 10px rgba(255, 255, 255, 0.1);
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

    /* Responsive Design */
    @media (max-width: 768px) {
      .card-custom {
        margin-bottom: 15px;
      }
      table {
        font-size: 0.9em;
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
                    <div class="col-md-3 col-6 mb-4">
                        <div class="card card-custom red">
                          <div class="card-body">
                            <h6 class="card-title text-center" style="color: white">{{ $miceSickCount }}</h6>
                            <p class="card-text text-center">Mice Sick</p>
                          </div>
                        </div>
                      </div>
                      
                    <div class="col-md-3 mb-4">
                        <div class="card card-custom blue">
                            <div class="card-body">
                                <h6 class="card-title text-center" style="color: white">{{ $maleHealthyCounts['category1'] }}</h6>
                                <p class="card-text text-center">Male Healthy ( < 10g)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card card-custom blue">
                            <div class="card-body">
                                <h6 class="card-title text-center" style="color: white">{{ $maleHealthyCounts['category2'] }}</h6>
                                <p class="card-text text-center">Male Healthy (10g - 22g)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card card-custom blue">
                            <div class="card-body">
                                <h6 class="card-title text-center" style="color: white">{{ $maleHealthyCounts['category3'] }}</h6>
                                <p class="card-text text-center">Male Healthy ( > 22g)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card card-custom pink">
                            <div class="card-body">
                                <h6 class="card-title text-center" style="color: white">{{ $femaleHealthyCounts['category1'] }}</h6>
                                <p class="card-text text-center">Female Healthy ( < 10g)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card card-custom pink">
                            <div class="card-body">
                                <h6 class="card-title text-center" style="color: white">{{ $femaleHealthyCounts['category2'] }}</h6>
                                <p class="card-text text-center">Female Healthy (10g - 22g)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card card-custom pink">
                            <div class="card-body">
                                <h6 class="card-title text-center" style="color: white">{{ $femaleHealthyCounts['category3'] }}</h6>
                                <p class="card-text text-center">Female Healthy ( > 22g)</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card kosong untuk menjaga keseimbangan layout -->
                    <div class="col-md-3 mb-4 d-none d-md-block"></div>
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
                            <!-- Penjelasan kategori -->
                            <p>* Category 1 : < 10gr</p>
                            <p>* Category 2 : 10g - 22gr</p>
                            <p>* Category 3 : > 22gr</p>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                
                
                <!-- Form Ubah Kategori Berat -->
                {{-- <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Kelola Kategori Berat</h5>
                    </div>
                    <div class="card-body">
                        <!-- Tambah Kategori -->
                        <form action="{{ route('master.categories.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Nama Kategori</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Range Berat</label>
                                    <input type="text" name="weight_range" class="form-control" required>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-success">Tambah Kategori</button>
                            </div>
                        </form>                        
                
                        <!-- Tabel Kategori -->
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Gender</th>
                                    <th>Nama Kategori</th>
                                    <th>Range Berat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td> <!-- loop->iteration menggantikan $index -->
                                    <td>{{ $category->gender }}</td>
                                    <td>
                                        <form action="{{ route('master.categories.update', $category->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="weight_range" value="{{ $category->weight_range }}" class="form-control">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
                                        </form>
                                        <form action="{{ route('master.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>                        
                    </div>
                </div>                 --}}
            </div>
                @include('partials.footer')
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    
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
  </script>
  </body>
</html>
