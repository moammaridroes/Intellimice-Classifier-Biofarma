<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Order</title>
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
</head>

<body>
  <div class="container-scroller">
    <!-- partial:_navbar.blade.php -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ url('/') }}"><img src="{{ asset('images/Logo_Bio_Farma.png') }}" style="width: 65%; height: 65%;" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}"><img src="{{ asset('images/logobiofarmakecil.png') }}" alt="logo"/></a>
      </div>

      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-start">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
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
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
        </div>
      </div>
      <!-- partial -->
      <!-- partial:_sidebar.blade.php -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Home</span>
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
                <li class="nav-item"><a class="nav-link" href="{{ url('orderhistory') }}">Order History</a></li>
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
                <li class="nav-item"> <a class="nav-link" href="{{ url('datatable') }}">Table Data</a></li>
              </ul>
            </div>
          </li>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Order History</h4>
                  <p class="card-description">
                    Agency Name
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            NO
                          </th>
                          <th>
                            DATE
                          </th>
                          <th>
                            WEIGHT ORDERED
                          </th>
                          <th>
                            AMOUNT OF ORDER
                          </th>
                          <th>
                            PICKUP DATE
                          </th>
                          <th>
                            ORDERER NAME
                          </th>
                          <th>
                            OPERATOR NAME
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="py-1">
                            1
                          </td>
                          <td>
                            25/05/2024
                          </td>
                          <td>
                            8 g
                          </td>
                          <td>
                            400
                          </td>
                          <td>
                            27/05/2024
                          </td>
                          <td>
                            Fullname
                          </td>
                          <td>
                            Fullname
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            2
                          </td>
                          <td>
                            28/05/2024
                          </td>
                          <td>
                            13g
                          </td>
                          <td>
                            400
                          </td>
                          <td>
                            29/05/2024
                          </td>
                          <td>
                            Fullname
                          </td>
                          <td>
                            Fullname
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            3
                          </td>
                          <td>
                            30/05/2024
                          </td>
                          <td>
                            13g
                          </td>
                          <td>
                            400
                          </td>
                          <td>
                            02/06/2024
                          </td>
                          <td>
                            Fullname
                          </td>
                          <td>
                            Fullname
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            4
                          </td>
                          <td>
                            04/06/2024
                          </td>
                          <td>
                            13g
                          </td>
                          <td>
                            400
                          </td>
                          <td>
                            05/06/2024
                          </td>
                          <td>
                            Fullname
                          </td>
                          <td>
                            Fullname
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            5
                          </td>
                          <td>
                            07/06/2024
                          </td>
                          <td>
                            13g
                          </td>
                          <td>
                            400
                          </td>
                          <td>
                            08/06/2024
                          </td>
                          <td>
                            Fullname
                          </td>
                          <td>
                            Fullname
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            6
                          </td>
                          <td>
                            10/06/2024
                          </td>
                          <td>
                            13g
                          </td>
                          <td>
                            400
                          </td>
                          <td>
                            11/06/2024
                          </td>
                          <td>
                            Fullname
                          </td>
                          <td>
                            Fullname
                          </td>
                        </tr>
                      </tbody>
                    </table>
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
</body>

</html>
