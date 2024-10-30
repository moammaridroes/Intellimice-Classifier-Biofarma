<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Online History</title>

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

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    .custom-swal-icon {
            margin-top: 30px; /* Adjust this to move the icon down */
        }
    .custom-swal-popup {
      padding-top: 40px; /* Adjust to increase spacing between title and icon */
    }
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

    .table-container {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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

    .dataTables_info, .dataTables_paginate {
      margin-top: 15px;
    }

    .dataTables_filter input, .dataTables_length select {
      border: 1px solid #ced4da;
      border-radius: 4px;
      padding: 5px 10px;
    }

    .dataTables_filter input:focus, .dataTables_length select:focus {
      outline: none;
      border-color: #80bdff;
      box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
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
          <span class="text-black font-weight-bold">{{ Auth::user()->name }}</span>
          <a class="nav-link p-0" href="#" data-toggle="dropdown" id="profileDropdown">
            <div class="ms-1 d-flex justify-content-center">
              <svg class="fill-current text-black" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z" clip-rule="evenodd" />
              </svg>
            </div>
          </a>

          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
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

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.notification') }}">
              <i class="ti-bell menu-icon"></i>
              <span class="menu-title">Notification</span>
              @if($unreadNotificationsCount > 0)
                <span class="badge badge-danger">{{ $unreadNotificationsCount }}</span>
              @endif
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
                <li class="nav-item"><a class="nav-link" href="{{ url('stok') }}">Data Table</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>

      <div class="main-panel">
        <div class="content-wrapper">
          <h4 class="card-title mb-4">Online Order History</h4>
          <div class="card">
            <div class="card-body">
              @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif

              <div class="table-container">
                <div class="table-responsive">
                  <table class="table table-striped yajra-datatable">
                    <thead>
                      <tr>
                        <th>Order ID</th>
                        <th>Fullname</th>
                        <th>Pick Up Date</th>
                        <th>Total Price</th>
                        <th>Payment Status</th>
                        <th>Details</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024, Biofarma. STAS-RG. All rights reserved.</span>
          </div>
        </footer>
      </div>
    </div>
  </div>

  <!-- Print Modal -->
  <div class="modal fade" id="printModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Print Order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="printContent"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="printButton" style="background-color: #4B49AC; border-color: #4B49AC;">Print</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Detail Modal -->
  <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailsModalLabel">Order Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
      // Inisialisasi Pusher
      const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
          cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
          encrypted: true,
      });
  
      // Subscribe ke channel
      const channel = pusher.subscribe('orders');
  
      // CSS untuk notifikasi
      const style = document.createElement('style');
      style.textContent = `
          .notification-container {
              position: fixed;
              top: 20px;
              right: 20px;
              background-color: #28a745;
              color: white;
              padding: 15px 25px;
              border-radius: 5px;
              box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
              z-index: 9000;
              opacity: 0;
              transform: translateY(-20px);
              transition: all 0.3s ease-in-out;
              max-width: 350px;
              word-wrap: break-word;
          }
  
          .notification-container.show {
              opacity: 1;
              transform: translateY(0);
          }
  
          .notification-container.hide {
              opacity: 0;
              transform: translateY(-20px);
          }
      `;
      document.head.appendChild(style);
  
      // Dengarkan event 'order.created'
      channel.bind('order.created', function(data) {
          // Buat container notifikasi
          const notificationContainer = document.createElement('div');
          notificationContainer.classList.add('notification-container');
          notificationContainer.textContent = `Pesanan baru dari ${data.order.fullname} untuk ${data.order.item_name}`;
          document.body.appendChild(notificationContainer);
  
          // Animasi munculnya notifikasi
          setTimeout(() => {
              notificationContainer.classList.add('show');
          }, 100);
  
          // Hilangkan notifikasi setelah 5 detik
          setTimeout(() => {
              notificationContainer.classList.add('hide');
              setTimeout(() => {
                  notificationContainer.remove();
              }, 300);
          }, 5000);
  
          // Update badge notifikasi
          let badge = document.querySelector('.nav-link .badge');
          if (badge) {
              let currentCount = parseInt(badge.textContent);
              badge.textContent = currentCount + 1;
          } else {
              badge = document.createElement('span');
              badge.classList.add('badge', 'badge-danger');
              badge.textContent = 1;
              document.querySelector('.nav-link').appendChild(badge);
          }
      });
      
    $(function () {
     var table = $('.yajra-datatable').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{ route('onlinehistory.getData') }}",
         order: [[0, 'desc']],
         columns: [
             {data: 'id', name: 'id', render: function (data, type, row) {
                 return 'ONL-' + data;
             }},
             {data: 'fullname', name: 'fullname'},
             {data: 'pick_up_date', name: 'pick_up_date'},
             {data: 'total_price', name: 'total_price', render: $.fn.dataTable.render.number(',', '.', 2, 'Rp ')},
             {
                 data: 'is_paid',
                 name: 'is_paid',
                 render: function (data, type, row) {
                     var statusClass = data === 'Paid' ? 'badge bg-success' : 'badge bg-danger';
                     return '<span class="' + statusClass + '">' + data + '</span>';
                 }
             },
             {
                 data: null,
                 orderable: false,
                 searchable: false,
                 render: function (data, type, row) {
                     return '<button class="btn btn-link details-button" data-bs-toggle="modal" data-bs-target="#detailsModal" data-details="' + encodeURIComponent(JSON.stringify(row)) + '"><i class="fas fa-eye"></i></button>';
                 }
             },
             {
             data: null,
             orderable: false,
             render: function (data) {
               return `<button class="btn btn-link print-button" data-id="${data.id}" style="color: #4B49AC"><i class="fas fa-print"></i></button>`;
             }
           }
         ],
         lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
         pageLength: 5,
         language: {
             search: "_INPUT_",
             searchPlaceholder: "Search records",
         },
         drawCallback: function() {
             $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
         }
     });
 
     // Handle click on print button
    $('.yajra-datatable').on('click', '.print-button', function () {
        var id = $(this).data('id');
        $.ajax({
            url: `/orderonline/details/${id}`, // Pastikan URL sesuai dengan route
            method: 'GET',
            success: function (data) {
                // Format tanggal
                const formattedDate = new Date(data.created_at).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
    
                // Format total price ke IDR
                const formattedTotalPrice = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(data.total_price || 0);
    
                // Pemetaan weight
                const weightMap = {
                    'less_than_8': '<8g',
                    'between_8_and_14': '8-14g',
                    'between_14_and_18': '14-18g',
                    'greater_equal_18': '>18g'
                };
                const mappedWeight = weightMap[data.weight] || data.weight;
    
                // Generate isi modal untuk print
                $('#printContent').html(`
                    <div class="text-center mb-4">
                        <h3>Payment Receipt</h3>
                        <p>Order ID: ONL-${data.id}</p>
                        <p>${formattedDate}</p>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr><th>Fullname</th><td>${data.fullname}</td></tr>
                            <tr><th>Phone Number</th><td>${data.phone_number}</td></tr>
                            <tr><th>Email</th><td>${data.email || '-'}</td></tr>
                            <tr><th>Item Name</th><td>${data.item_name}</td></tr>
                            <tr><th>Agency Name</th><td>${data.agency_name || '-'}</td></tr>
                            <tr><th>Pick Up Date</th><td>${data.pick_up_date ? new Date(data.pick_up_date).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }) : '-'}</td></tr>
                            <tr><th>Weight</th><td>${mappedWeight}</td></tr>
                            <tr><th>Male Quantity</th><td>${data.male_quantity || 0}</td></tr>
                            <tr><th>Female Quantity</th><td>${data.female_quantity || 0}</td></tr>
                            <tr><th>Total Price</th><td>${formattedTotalPrice}</td></tr>
                            <tr><th>Payment Status</th><td>${data.is_paid ? 'Paid' : 'Unpaid'}</td></tr>
                        </tbody>
                    </table>
                    <div class="text-center mt-4">
                        <p>Thank you for your order!</p>
                        <p>Biofarma STAS-RG</p>
                    </div>
                `);
                $('#printModal').modal('show');
            },
            error: function (xhr) {
                alert('Error: ' + xhr.responseText || 'Failed to load order details.');
            }
        });
    });
 
    // Handle print action
    $('#printButton').on('click', function () {
        var content = document.getElementById('printContent').innerHTML;
        var originalContent = document.body.innerHTML;
    
        document.body.innerHTML = content;
        window.print(); // Buka dialog print
        document.body.innerHTML = originalContent;
    
        // Reload halaman setelah print selesai untuk mencegah masalah tampilan
        location.reload();
    });
 
     // Handle click on details button
     $('.yajra-datatable').on('click', '.details-button', function () {
         var data = JSON.parse(decodeURIComponent($(this).data('details')));
         var modalBody = $('#detailsModal .modal-body');
         var modalFooter = $('#detailsModal .modal-footer');
 
         // Kosongkan modal sebelum menambahkan data baru
         modalBody.empty();
         modalFooter.find('.mark-paid-button, .mark-unpaid-button').remove(); // Hapus tombol lama jika ada

         modalBody.append('<p><strong>Order ID:</strong> ' + 'ONL-' + data.id + '</p>');
         modalBody.append('<p><strong>Fullname:</strong> ' + data.fullname + '</p>');
         modalBody.append('<p><strong>Phone Number:</strong> ' + data.phone_number + '</p>');
         modalBody.append('<p><strong>Email:</strong> ' + data.email + '</p>');
         modalBody.append('<p><strong>Item Name:</strong> ' + data.item_name + '</p>');
         modalBody.append('<p><strong>Pick Up Date:</strong> ' + data.pick_up_date + '</p>');
         modalBody.append('<p><strong>Weight:</strong> ' + data.weight + '</p>');
         modalBody.append('<p><strong>Male Quantity:</strong> ' + data.male_quantity + '</p>');
         modalBody.append('<p><strong>Female Quantity:</strong> ' + data.female_quantity + '</p>');
         modalBody.append('<p><strong>Total Price:</strong> ' + data.total_price + '</p>');
         modalBody.append('<p><strong>Payment Status:</strong> ' + data.is_paid + '</p>');
 
         // Jika status pembayaran Unpaid, tampilkan tombol "Mark as Paid"
         if (data.is_paid === 'Unpaid') {
             var markPaidButton = $('<button type="button" class="btn btn-success mark-paid-button">Mark as Paid</button>');
             modalFooter.prepend(markPaidButton);
 
             // Event handler untuk tombol "Mark as Paid"
             markPaidButton.on('click', function() {
                $.ajax({
                    url: '/customer-orders/' + data.id + '/mark-as-paid',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Show SweetAlert success message
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: response.message || "Order has been marked as paid and stock updated!",
                            confirmButtonText: "OK",
                            customClass: {
                              popup: 'custom-swal-popup', // Apply this class to the entire popup for layout adjustments
                              icon: 'custom-swal-icon' // Adjust the icon specifically
                          }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#detailsModal').modal('hide');
                                table.ajax.reload(null, false); // Reload the DataTable to reflect the change
                            }
                        });
                    },
                   error: function(xhr) {
                // Show SweetAlert error message instead of alert
                      Swal.fire({
                          icon: "error",
                          title: "Oops...",
                          text: xhr.responseJSON.message || "Something went wrong!",
                          customClass: {
                              popup: 'custom-swal-popup', // Apply this class to the entire popup for layout adjustments
                              icon: 'custom-swal-icon' // Adjust the icon specifically
                          }
                        });
                      }
                  });
              });
          }
         
         // Jika status pembayaran Paid, tampilkan tombol "Mark as Unpaid"
         // else if (data.is_paid === 'Paid') {
         //     var markUnpaidButton = $('<button type="button" class="btn btn-danger mark-unpaid-button">Mark as Unpaid</button>');
         //     modalFooter.prepend(markUnpaidButton);
 
         //     // Event handler untuk tombol "Mark as Unpaid"
         //     markUnpaidButton.on('click', function() {
         //         $.ajax({
         //             url: '/customer-orders/' + data.id + '/mark-as-unpaid',
         //             type: 'POST',
         //             data: {
         //                 _token: '{{ csrf_token() }}'
         //             },
         //             success: function(response) {
         //                 alert('Order has been marked as unpaid.');
         //                 $('#detailsModal').modal('hide');
         //                 table.ajax.reload(null, false);
         //             },
         //             error: function(xhr) {
         //                 alert('An error occurred while updating the payment status.');
         //             }
         //         });
         //     });
         // }
        });     
      });
   </script>
 </body>
 </html>
 
