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

</head>
<style>
.sidebar-offcanvas {
    height: 100vh;
    overflow-y: auto;
}

/* Tombol menu untuk mode mobile */
.mobile-menu-btn {
    display: none;
    font-size: 1.5rem;
    cursor: pointer;
    margin-right: 10px;
}

/* Tombol untuk menutup sidebar di tampilan mobile */
.close-sidebar-btn {
    display: none;
    position: absolute;
    top: 15px;
    left: 15px;
    font-size: 1.5rem;
    cursor: pointer;
    color: #333;
}

@media (max-width: 767px) {
    .mobile-menu-btn {
        display: inline;
    }

    .sidebar-offcanvas {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 200px;
        height: 100vh;
        background-color: #ffffff;
        z-index: 1050;
        padding-top: 60px;
        border-right: 1px solid #ddd;
    }

    .sidebar-offcanvas.active {
        display: block;
    }

    .sidebar-offcanvas.active .close-sidebar-btn {
        display: inline;
    }
}

</style> 


<body>
    <div class="container-scroller">
        @include('partials.navbarCustomer')
        
    
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <span class="close-sidebar-btn" onclick="toggleSidebar()">
            <i class="fas fa-times"></i>
        </span>
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

          <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Data Collecting</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/') }}">Data Table</a></li>
              </ul>
            </div>
          </li> -->
        </ul>
      </nav>
      <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">@lang('messages.pending_orders')</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $pendingCount }}
                                            <span class="text-warning text-sm font-weight-bolder">@lang('messages.pending')</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">@lang('messages.approved_orders')</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $approvedCount }}
                                            <span class="text-success text-sm font-weight-bolder">@lang('messages.approved')</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">@lang('messages.rejected_orders')</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $rejectedCount }}
                                            <span class="text-danger text-sm font-weight-bolder">@lang('messages.rejected')</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h4 class="text-capitalize">Description</h4>
                        {{-- <p class="text-sm mb-0">
                            <i class="ti-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% more</span> in 2024
                        </p> --}}
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <img src="{{ asset('images/Logo_Bio_Farma.png') }}" style="width: 65%; height: 65%;" class="mr-2" alt="logo" />
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nobis culpa dolorum iusto ratione, possimus non est exercitationem, optio aliquam assumenda aliquid veniam, unde ut ad? Excepturi consectetur enim alias maxime!</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, nemo? Dolore quibusdam repellendus, amet earum repellat asperiores numquam voluptatum illum, explicabo corporis rerum mollitia molestiae quae aliquid blanditiis deserunt nemo?</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5">
                <div class="card rounded-lg overflow-hidden">
                    <div class="card-header pb-0 p-3 bg-gradient-to-r from-purple-500 to-indigo-500">
                        <h4 class="mb-0 text-black font-bold">@lang('messages.booking_procedure')</h4>
                    </div>
                    <div class="card-body p-4">
                        <ul class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="bg-blue-600 p-3 rounded-full flex items-center justify-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="3.2em" height="3.2em" viewBox="0 0 24 24"><path fill="#5742f5" d="M17 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2M1 2v2h2l3.6 7.59l-1.36 2.45c-.15.28-.24.61-.24.96a2 2 0 0 0 2 2h12v-2H7.42a.25.25 0 0 1-.25-.25q0-.075.03-.12L8.1 13h7.45c.75 0 1.41-.42 1.75-1.03l3.58-6.47c.07-.16.12-.33.12-.5a1 1 0 0 0-1-1H5.21l-.94-2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2"/></svg>                                </div>
                                <div>
                                    <h6 class="text-lg font-semibold text-gray-800">@lang('messages.order_carefully')</h6>
                                    <p class="text-sm text-gray-600">@lang('messages.order_carefully_description').</p>
                                </div>
                                <div class="flex items-start space-x-4">
                                <div class="bg-teal-600 p-3 rounded-full flex items-center justify-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="3.2em" height="3.2em" viewBox="0 0 32 32"><path fill="#5742f5" d="M22.318 3.318a4.5 4.5 0 0 1 6.364 6.364l-8.66 8.66a3 3 0 0 1-1.292.762l-6.453 1.857a1 1 0 0 1-1.238-1.237l1.857-6.454a3 3 0 0 1 .762-1.292zM16 6q.721 0 1.415.1l1.693-1.694A12 12 0 0 0 16 4C9.373 4 4 9.373 4 16s5.373 12 12 12s12-5.373 12-12c0-1.075-.141-2.117-.407-3.108l-1.692 1.693q.098.694.099 1.415c0 5.523-4.477 10-10 10S6 21.523 6 16S10.477 6 16 6"/></svg>
                                    </div>
                                <div>  
                                    <h6 class="text-lg font-semibold text-gray-800">@lang('messages.check_status')</h6>
                                    <p class="text-sm text-gray-600">@lang('messages.check_status_description').</p>
                                </div>
                                </div>
 
                            <div class="flex items-start space-x-4">
                                <div class="bg-pink-600 p-3 rounded-full flex items-center justify-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="3.2em" height="3.2em" viewBox="0 0 24 24"><path fill="#5742f5" d="M3 5.25A2.25 2.25 0 0 1 5.25 3h9.5A2.25 2.25 0 0 1 17 5.25V14h4v3.75A3.25 3.25 0 0 1 17.75 21H6.25A3.25 3.25 0 0 1 3 17.75zM17 19.5h.75a1.75 1.75 0 0 0 1.75-1.75V15.5H17zM6.5 7.75c0 .414.336.75.75.75h5.5a.75.75 0 0 0 0-1.5h-5.5a.75.75 0 0 0-.75.75M7.25 11a.75.75 0 0 0 0 1.5h5.5a.75.75 0 0 0 0-1.5zm-.75 4.75c0 .414.336.75.75.75h3a.75.75 0 0 0 0-1.5h-3a.75.75 0 0 0-.75.75"/></svg>
                                    </div>
                                <div>
                                    <h6 class="text-lg font-semibold text-gray-800">@lang('messages.download_receipt')</h6>
                                    <p class="text-sm text-gray-600">@lang('messages.download_receipt_description').</p>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="flex items-center">
                                        <div class="bg-blue-600 p-3 rounded-full flex items-center justify-center shadow-md mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="3.2em" height="3.2em" viewBox="0 0 12 12"><path fill="#5742f5" d="M1.05 3A2.5 2.5 0 0 1 3.5 1h5a2.5 2.5 0 0 1 2.45 2zM1 4v4.5A2.5 2.5 0 0 0 3.5 11h5A2.5 2.5 0 0 0 11 8.5V4zm2 1.5a.5.5 0 1 1 1 0a.5.5 0 0 1-1 0m0 2a.5.5 0 1 1 1 0a.5.5 0 0 1-1 0M5.5 5a.5.5 0 1 1 0 1a.5.5 0 0 1 0-1M5 7.5a.5.5 0 1 1 1 0a.5.5 0 0 1-1 0M7.5 5a.5.5 0 1 1 0 1a.5.5 0 0 1 0-1"/></svg>
                                        </div>
                                        <div>
                                            <h6 class="text-lg font-semibold text-gray-800">@lang('messages.pickup_time')</h6>
                                            <p class="text-sm text-gray-600">@lang('messages.pickup_time_description').</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="bg-green-500 p-3 rounded-full flex items-center justify-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="4.21em" height="2.6em" viewBox="0 0 1920 1280"><path fill="#5742f5" d="M768 896h384v-96h-128V352H910L762 489l77 80q42-37 55-57h2v288H768zm512-256q0 70-21 142t-59.5 134t-101.5 101t-138 39t-138-39t-101.5-101T661 782t-21-142t21-142t59.5-134T822 263t138-39t138 39t101.5 101t59.5 134t21 142m512 256V384q-106 0-181-75t-75-181H384q0 106-75 181t-181 75v512q106 0 181 75t75 181h1152q0-106 75-181t181-75m128-832v1152q0 26-19 45t-45 19H64q-26 0-45-19t-19-45V64q0-26 19-45T64 0h1792q26 0 45 19t19 45"/></svg>
                                    </div>
                                <div>
                                    <h6 class="text-lg font-semibold text-gray-800">@lang('messages.pay_onsite')</h6>
                                    <p class="text-sm text-gray-600">@lang('messages.pay_onsite_description')</p>
                                </div>
                        </ul>
                    </div>
                </div>
            </div>
            
                        
        </div>
    </div>
                      <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        @include('partials.footer')
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
  <script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("active");
    }

    </script>
</body>

</html>
