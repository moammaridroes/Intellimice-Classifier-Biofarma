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
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/logobiofarmakecil.png') }}" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
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
              <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
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
    <!-- Navbar ends -->

    <div class="container-fluid page-body-wrapper">
      <!-- Settings Panel -->
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
      <!-- Settings Panel ends -->

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
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
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
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Data Collecting</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ url('stok') }}">Table Data</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- Sidebar ends -->

      <!-- Main Content -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Set Orderer Info</h4>
                  <p class="card-description">Fill in required order info</p>
                  <form class="forms-sample" id="orderForm">
                    @csrf
                    <div class="form-group">
                      <label for="fullname">Fullname</label>
                      <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Fullname" required>
                    </div>
                    <div class="form-group">
                      <label for="phone_number">Phone Number</label>
                      <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                      <label for="item_name">Name of item ordered</label>
                      <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Name of item ordered" required>
                    </div>
                    <div class="form-group">
                      <label for="agency_name">Agency Name</label>
                      <input type="text" class="form-control" name="agency_name" id="agency_name" placeholder="Agency Name" required>
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
                  <label for="operator_name">Full Name</label>
                  <input type="text" class="form-control" id="operator_name" name="operator_name" value="{{ Auth::user()->name }}" readonly>
                </div>

                <h4 class="card-title">Set Weight</h4>
                <div class="form-group">
                  <label>Fill in the required amount of order</label>
                  <div class="input-group">
                    <input type="number" class="form-control" name="weight" id="weightInput" placeholder="Weight Ordered" oninput="validateWeight()">
                    <div class="input-group-append">
                      <span class="input-group-text bg-transparent text-black font-semibold">gr</span>
                    </div>
                  </div>
                  <div id="weightError" class="error-message">Please input weight more than 0</div>
                </div>

                <h4 class="card-title">Set amount of order</h4>
                <div class="form-group">
                  <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" id="maleCheckbox"> Male
                    </label>
                  </div>
                  <input type="number" class="form-control form-control-lg" id="maleQuantity" name="male_quantity" placeholder="Quantity" min="1" value="0" oninput="validateAndCalculate(this)" disabled>
                </div>
                <div class="form-group">
                  <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" id="femaleCheckbox"> Female
                    </label>
                  </div>
                  <input type="number" class="form-control form-control-lg" id="femaleQuantity" name="female_quantity" placeholder="Quantity" min="1" value="0" oninput="validateAndCalculate(this)" disabled>
                </div>
                <div class="form-group">
                  <label>Total</label>
                  <input type="number" class="form-control form-control-lg" id="totalQuantity" placeholder="Total" readonly>
                </div>
                <button type="submit" class="btn btn-primary mr-2" style="background-color: #4B49AC; border-color: #4B49AC;" id="submitOrderButton">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Main Content ends -->

      <!-- Invoice Modal -->
      <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="invoiceModalLabel">Invoice</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Invoice nnti disini -->
              <div id="invoiceContent"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" style="background-color: #4B49AC; border-color: #4B49AC;" id="payButton">Bayar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Invoice Modal ends -->

      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024, Biofarma. STAS-RG. All rights reserved.</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"></span>
        </div>
      </footer>
      <!-- footer ends -->

    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- Plugin js for this page -->
  <script src="{{ asset('vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  <!-- Custom js for this page-->
  <script src="{{ asset('js/file-upload.js') }}"></script>
  <script src="{{ asset('js/typeahead.js') }}"></script>
  <script src="{{ asset('js/select2.js') }}"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script>
    function validateWeight() {
      var weightInput = document.getElementById('weightInput');
      var errorDiv = document.getElementById('weightError');
      var weightValue = parseInt(weightInput.value) || 0;

      if (weightValue <= 0) {
        weightInput.style.borderColor = 'red';
        errorDiv.style.display = 'block'; 
      } else {
        weightInput.style.borderColor = '';
        errorDiv.style.display = 'none'; 
      }
    }

    document.getElementById('maleCheckbox').addEventListener('change', function () {
      toggleInput('maleQuantity', this.checked);
    });

    document.getElementById('femaleCheckbox').addEventListener('change', function () {
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
    
    //Logic ni ruwet kali
    document.addEventListener("DOMContentLoaded", () => {
      // Submit Order Button Clicked
      document.getElementById("submitOrderButton").addEventListener("click", function (e) {
        e.preventDefault(); // Prevent form from submitting
        // Fetch form data
        const orderData = {
          fullname: document.querySelector("input[name='fullname']").value,
          phone_number: document.querySelector("input[name='phone_number']").value,
          email: document.querySelector("input[name='email']").value,
          item_name: document.querySelector("input[name='item_name']").value,
          agency_name: document.querySelector("input[name='agency_name']").value,
          operator_name: document.querySelector("input[name='operator_name']").value,
          weight: document.querySelector("input[name='weight']").value,
          male_quantity: document.querySelector("input[name='male_quantity']").value || 0,
          female_quantity: document.querySelector("input[name='female_quantity']").value || 0,
          total_price: calculateTotalPrice() 
        };
        // Show invoice modal with fetched data
        showInvoiceModal(orderData);
      });

      // Calculate total price based on the input data
      function calculateTotalPrice() {
        const maleQuantity = parseInt(document.querySelector("input[name='male_quantity']").value) || 0;
        const femaleQuantity = parseInt(document.querySelector("input[name='female_quantity']").value) || 0;
        const malePrice = 4000; 
        const femalePrice = 5000; 
        return (maleQuantity * malePrice) + (femaleQuantity * femalePrice);
      }

      // Function to show invoice modal with order data
      function showInvoiceModal(order) {
        const invoiceContent = `
          <h5 class="card-title">Order Details</h5>
          <p><strong>Fullname:</strong> ${order.fullname}</p>
          <p><strong>Phone Number:</strong> ${order.phone_number}</p>
          <p><strong>Email:</strong> ${order.email}</p>
          <p><strong>Item Name:</strong> ${order.item_name}</p>
          <p><strong>Agency Name:</strong> ${order.agency_name}</p>
          <p><strong>Operator Name:</strong> ${order.operator_name}</p>
          <p><strong>Weight:</strong> ${order.weight} gr</p>
          <p><strong>Male Quantity:</strong> ${order.male_quantity}</p>
          <p><strong>Female Quantity:</strong> ${order.female_quantity}</p>
          <h5 class="card-text">Total Price: Rp ${order.total_price.toLocaleString('id-ID')}</h5>
          <p><strong>Status:</strong> Unpaid</p>
        `;
        document.getElementById("invoiceContent").innerHTML = invoiceContent;
        document.getElementById("payButton").disabled = false; // Enable pay button
        var invoiceModal = new bootstrap.Modal(document.getElementById('invoiceModal'));
        invoiceModal.show(); // Show modal using Bootstrap 5
      }

      // Pay button click event
      document.getElementById("payButton").addEventListener("click", function () {
        // Send AJAX request to store order in the database
        const orderData = {
          _token: '{{ csrf_token() }}',
          fullname: document.querySelector("input[name='fullname']").value,
          phone_number: document.querySelector("input[name='phone_number']").value,
          email: document.querySelector("input[name='email']").value,
          item_name: document.querySelector("input[name='item_name']").value,
          agency_name: document.querySelector("input[name='agency_name']").value,
          operator_name: document.querySelector("input[name='operator_name']").value,
          weight: document.querySelector("input[name='weight']").value,
          male_quantity: document.querySelector("input[name='male_quantity']").value || 0,
          female_quantity: document.querySelector("input[name='female_quantity']").value || 0,
          total_price: calculateTotalPrice()
        };

        fetch('{{ url('submit-order') }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': orderData._token
          },
          body: JSON.stringify(orderData)
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert("Order has been paid successfully!");
              document.getElementById("payButton").disabled = true;
              document.getElementById("invoiceContent").innerHTML += "<p><strong>Status:</strong> Paid</p>";
              var invoiceModal = bootstrap.Modal.getInstance(document.getElementById('invoiceModal'));
              invoiceModal.hide(); 
            } else {
              alert("Failed to process payment!");
            }
          })
          .catch(error => console.error('Error:', error));
      });
    });
  </script>
</body>

</html>
