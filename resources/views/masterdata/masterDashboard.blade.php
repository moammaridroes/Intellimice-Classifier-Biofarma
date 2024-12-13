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

</head>
<style>
    /* Kustomisasi warna card */
.card-custom {
  border-radius: 10px;
  box-shadow: 0px 4px 6px rgba(253, 253, 253, 0.1);
  transition: all 0.3s ease;
}

.card-custom .card-body {
  color: white;
  padding: 20px;
}

.card-custom h5 {
  font-size: 1.25rem;
  font-weight: 600;
}

.card-custom p {
  font-size: 1rem;
  font-weight: 400;
}

/* Warna spesifik untuk masing-masing card */
.orange {
  background-color: #fe9365; /* Warna orange */
}

.green {
  background-color: #0ac282; /* Warna hijau */
}

.red {
  background-color: #fe6072; /* Warna merah */
}

.blue {
  background-color: #01acaf; /* Warna biru */
}

/* Efek hover pada card */
.card-custom:hover {
  transform: translateY(-10px);
  box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
}

</style> 


<body>
    <div class="container-scroller">
        @include('partials.navbarAdmin')
        @include('partials.sidebarMaster')
        <!-- Main Content -->
        <div class="main-panel">
            <div class="content-wrapper">
                <!-- Card Container -->
                <div class="row">
                  <!-- Card 1: Oren -->
                  <div class="col-md-3 mb-4">
                    <div class="card card-custom orange">
                      <div class="card-body">
                        <h5 class="card-title" style="color: white;">{{ $userCount }}</h5>
                        <p class="card-text">User Total</p>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Card 2: Hijau -->
                  <div class="col-md-3 mb-4">
                    <div class="card card-custom green">
                      <div class="card-body">
                        <h5 class="card-title" style="color: white;">Rp {{ number_format($totalEarnings, 0, ',', '.') }}</h5>
                        <p class="card-text">Total Earnings</p>
                      </div>
                    </div>
                  </div>
              
                  <!-- Card 3: Merah -->
                  <div class="col-md-3 mb-4">
                    <div class="card card-custom red">
                      <div class="card-body">
                        <h5 class="card-title" style="color: white;">{{ number_format($totalOrders, 0, ',', '.') }}</h5>
                        <p class="card-text">Total Transaction</p>
                      </div>
                    </div>
                  </div>
              
                  <!-- Card 4: Biru -->
                  <div class="col-md-3 mb-4">
                    <div class="card card-custom blue">
                      <div class="card-body">
                        <h5 class="card-title" style="color: white;">{{ number_format($mencitOrders, 0, ',', '.') }}</h5>
                        <p class="card-text">Mice Sold</p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-custom" style="background-color: #ffffff;">
                            <div class="card-body">
                                <h5 class="card-title" style="color: rgb(0, 0, 0);">Sales Chart for {{ date('Y') }}</h5>
                                <canvas id="salesChart"></canvas>
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
  const salesData = @json($salesData); // Data penjualan (bulan dan pendapatan)
  const currentYear = {{ $currentYear }}; // Tahun saat ini yang dipilih

  // Konfigurasi Chart.js
  const ctx = document.getElementById('salesChart').getContext('2d');
  let salesChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: salesData.months,
          datasets: [{
              label: 'Penjualan',
              data: salesData.sales,
              borderColor: '#4caf50',
              backgroundColor: 'rgba(76, 175, 80, 0.2)',
              fill: true,
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });

  document.getElementById('yearSelect').addEventListener('change', function () {
    const selectedYear = this.value;

    fetch(`/masterdata/home/${selectedYear}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Update grafik dengan data baru
            salesChart.data.labels = data.salesData.months;
            salesChart.data.datasets[0].data = data.salesData.sales;
            salesChart.update();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            alert('Failed to fetch data. Please try again.');
        });
});


  </script>

  </body>
  </html>