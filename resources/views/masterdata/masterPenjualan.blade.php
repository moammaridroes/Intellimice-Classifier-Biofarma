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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/logobiofarmakecil.png') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <div class="container-scroller">
    @include('partials.navbarAdmin')
    @include('partials.sidebarMaster')
    <!-- Main Content -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="container mt-4">
          <h2 class="mb-4">Sales Report</h2>

          <!-- Dropdown Tahun -->
          <div class="form-group">
            <label for="yearSelect">Select Year:</label>
            <select id="yearSelect" class="form-select w-25 mb-3">
              @foreach ($years as $year)
              <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>{{ $year }}</option>
              @endforeach
            </select>
          </div>

          <!-- Grafik Penjualan -->
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">Sales Chart</h5>
              <canvas id="salesChart"></canvas>
            </div>
          </div>

          <div class="row">
            <!-- Tabel Penjualan -->
            <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Sales Table</h5>
                  <div class="table-responsive">
                    <table class="table table-striped yajra-datatable">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Month</th>
                          <th>Total Sales</th>
                          <th>Male Mice Sold</th>
                          <th>Female Mice Sold</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Chart Lingkaran -->
            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <div style="display: flex; justify-content: center;">
                    <h5 class="card-title">Sales Comparison</h5>
                  </div>
                  <canvas id="comparisonChart"></canvas>
                </div>
              </div>
            </div>
          </div>

            <div style="margin-top: 2rem;"></div>
            <div class="row">
                <!-- Grafik Transaksi Online dan Offline -->
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Monthly Transactions</h5>
                            <canvas id="transactionChart"></canvas> <!-- Chart untuk transaksi -->
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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

  <!-- Required JS Files -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function () {
      const yearSelect = document.getElementById('yearSelect');
      const salesChart = document.getElementById('salesChart').getContext('2d');
      const comparisonChart = document.getElementById('comparisonChart').getContext('2d');
      const transactionChartCtx = document.getElementById('transactionChart').getContext('2d');
      let chart, pieChart, transactionChart;
  
      function fetchData(year) {
        $.ajax({
          url: `/masterdata/penjualan/${year}`,
          type: 'GET',
          success: function (response) {
            // Update chart transaksi bulanan
            if (transactionChart) transactionChart.destroy();
            transactionChart = new Chart(transactionChartCtx, {
              type: 'bar', // Menggunakan bar chart untuk transaksi
              data: {
                labels: response.chartData.months, // Bulan
                datasets: [
                  {
                    label: 'Online Transactions', // Label dataset untuk transaksi online
                    data: response.chartData.onlineTransactions, // Data transaksi online
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang batang
                    borderColor: 'rgba(75, 192, 192, 1)', // Warna border batang
                    borderWidth: 1 // Ketebalan border
                  },
                  {
                    label: 'Offline Transactions', // Label dataset untuk transaksi offline
                    data: response.chartData.offlineTransactions, // Data transaksi offline
                    backgroundColor: 'rgba(153, 102, 255, 0.2)', // Warna latar belakang batang
                    borderColor: 'rgba(153, 102, 255, 1)', // Warna border batang
                    borderWidth: 1 // Ketebalan border
                  }
                ]
              },
              options: {
                responsive: true,
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
  
            // Update DataTable
            $('.yajra-datatable').DataTable({
              processing: true,
              serverSide: false,
              destroy: true,
              data: response.tableData,
              pageLength: 6,
              columns: [
                { data: 'index' },
                { data: 'month' },
                { data: 'totalSales' },
                { data: 'maleSold' },
                { data: 'femaleSold' },
              ]
            });
  
            // Update Bar Chart (Total Sales)
            if (chart) chart.destroy();
            chart = new Chart(salesChart, {
              type: 'bar',
              data: {
                labels: response.chartData.months,
                datasets: [{
                  label: 'Total Sales',
                  data: response.chartData.sales,
                  backgroundColor: '#4B49AC', // Warna chartny
                }]
              },
              options: {
                responsive: true,
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
  
            // Update Pie Chart (Sales Comparison)
            if (pieChart) pieChart.destroy();
            pieChart = new Chart(comparisonChart, {
              type: 'pie',
              data: {
                labels: ['Online', 'Offline'],
                datasets: [{
                  data: [
                    response.comparisonData.onlineSales,
                    response.comparisonData.offlineSales
                  ],
                  backgroundColor: ['#4caf50', '#2196f3'],
                }]
              },
              options: {
                responsive: true,
              }
            });
          },
          error: function () {
            alert('Error fetching data.');
          }
        });
      }
  
      // Initial data fetch when the page loads
      fetchData(yearSelect.value);
  
      // Fetch new data on year change
      yearSelect.addEventListener('change', function () {
        fetchData(this.value);
      });
    });
  </script>
  
</body>

</html>
