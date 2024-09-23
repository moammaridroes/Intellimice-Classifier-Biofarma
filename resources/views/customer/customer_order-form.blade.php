
<!DOCTYPE html>
<html lang="en">
<form class="forms-sample" method="POST" action="{{ url('submit-order-customer') }}">
  @csrf
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
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
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
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('customer/home') }}">
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
                <li class="nav-item"><a class="nav-link" href="{{ url('customer/orderform') }}">Order Forms</a></li>
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
                <li class="nav-item"> <a class="nav-link" href="{{ url('stok') }}">Table Data</a></li>
              </ul>
            </div>
          </li>
      </nav>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Set Orderer Info</h4>
                  <p class="card-description">
                    Fill in required order info
                  </p>
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="fullname">Fullname</label>
                      <input type="text" class="form-control" name="fullname" id="exampleInputUsername1" placeholder="Fullname" required>
                    </div>
                    <div class="form-group">
                      <label for="phoneNumber">Phone Number</label>
                      <!-- <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Phone Number"> -->
                      <input type="number" class="form-control" name="phone_number" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email"> -->
                      <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                      <label for="nameItem">Name of item ordered</label>
                      <!-- <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Name of item ordered"> -->
                      <input type="text" class="form-control" name="item_name" placeholder="Name of item ordered" required>
                    </div>
                    <div class="form-group">
                      <label for="agency">Agency Name</label>
                      <!-- <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Agency Name"> -->
                      <input type="text" class="form-control" name="agency_name" placeholder="Agency Name" required>
                    </div> 
                  </form>
                </div>
              </div>
            </div>
            
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Operator Data</h4>
                  <div class="form-group">
                      <label for ="operatorName">Full Name</label>
                      <select class="form-control form-control-lg" id="operatorName" name="operator_name">
                          <option value="" disabled selected>Select Operator</option>
                          <option value="Admin1">Admin 1</option>
                          <option value="Admin2">Admin 2</option>
                          <option value="Admin3">Admin 3</option>
                      </select>
                  </div>

                  <h4 class="card-title">Set Weight</h4>
                  <div class="form-group">
                    <label>Fill in the required amount of order</label>
                    <div class="input-group">
                      <!-- Input field -->
                      <input type="number" class="form-control" name="weight" placeholder="Weight Ordered" aria-label="Weight Ordered" oninput="validateWeight()">
                      <!-- Satuan gr -->
                      <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-black font-semibold">gr</span>
                      </div>
                    </div>
                    <!-- Error message -->
                    <div id="weightError" class="error-message" style="color: red; display: none;">Please input weight more than 0</div>
                  </div>
                  
                  <h4 class="card-title">Set amount of order</h4>
                  <div class="form-group">
                    <div class="form-check form-check-flat form-check-primary">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="maleCheckbox">
                        Male
                      </label>
                    </div>
                    <input type="number" class="form-control form-control-lg" id="maleQuantity" name="male_quantity" placeholder="Quantity" min="1" value="0" oninput="validateAndCalculate(this)" disabled>
                  </div>
                  <div class="form-group">
                    <div class="form-check form-check-flat form-check-primary">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="femaleCheckbox">
                        Female
                      </label>
                    </div>
                    <input type="number" class="form-control form-control-lg" id="femaleQuantity" name="female_quantity" placeholder="Quantity" min="1" value="0" oninput="validateAndCalculate(this)" disabled>
                  </div>
                  <div class="form-group">
                    <label>Total</label>
                    <input type="number" class="form-control form-control-lg" id="totalQuantity" placeholder="Total" readonly>
                  </div>
                  <button type="submit" class="btn btn-primary mr-2">Submit</button>    
                </div>
              </div>
            </div>

            <script>
              function validateWeight() {
                var weightInput = document.getElementById('weightInput');
                var errorDiv = document.getElementById('weightError');
                var weightValue = parseInt(weightInput.value) || 0;

                // Check input user
                if (weightValue <= 0) {
                  weightInput.style.borderColor = 'red'; 
                  errorDiv.style.display = 'block'; // tampilkan pesan eror
                } else {
                  weightInput.style.borderColor = ''; 
                  errorDiv.style.display = 'none'; // Hide pesan error
                }
              }
            document.getElementById('maleCheckbox').addEventListener('change', function() {
                toggleInput('maleQuantity', this.checked);
            });

            document.getElementById('femaleCheckbox').addEventListener('change', function() {
                toggleInput('femaleQuantity', this.checked);
            });

            function toggleInput(inputId, isChecked) {
                var input = document.getElementById(inputId);
                input.disabled = !isChecked;
                if (isChecked) {
                    input.value = '';
                    input.focus();
                } else {
                    input.value = 0;
                    calculateTotal();
                }
            }

            function validateAndCalculate(input) {
                if (input.value < 0) {
                    input.value = 0;
                }
                calculateTotal();
            }

            function calculateTotal() {
                var maleQuantity = parseInt(document.getElementById('maleQuantity').value) || 0;
                var femaleQuantity = parseInt(document.getElementById('femaleQuantity').value) || 0;
                var totalQuantity = maleQuantity + femaleQuantity;
                document.getElementById('totalQuantity').value = totalQuantity;
            }
            </script>
            
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
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
  <script src="{{ asset('vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('js/file-upload.js') }}"></script>
  <script src="{{ asset('js/typeahead.js') }}"></script>
  <script src="{{ asset('js/select2.js') }}"></script>
  <!-- End custom js for this page-->
</body>
</form>
</html>