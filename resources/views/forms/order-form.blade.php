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

<style>
    .custom-swal-icon {
            margin-top: 30px; /* Adjust this to move the icon down */
        }
        .custom-swal-popup {
        padding-top: 40px; /* Adjust to increase spacing between title and icon */
        }
</style>

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
            <a class="nav-link" href="{{ route('admin.notification') }}">
                <i class="ti-bell menu-icon"></i>
                <span class="menu-title">Notification</span>
                @if($unreadNotificationsCount > 0)
                    <span class="badge badge-danger">{{ $unreadNotificationsCount }}</span>
                @endif
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
                    <h4 class="card-title">Operator Data</h4>
                  <div class="form-group">
                    <label for="operator_name">Full Name</label>
                    <input type="text" class="form-control" id="operator_name" name="operator_name" value="{{ Auth::user()->name }}" readonly>
                  </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Set Weight</h4>
                  <div class="form-group">
                    <label>Weight Category</label>
                    <select class="form-control" name="weight" id="weightSelect" onchange="fetchStockCount()">
                      <option value="" selected disabled>Select Weight</option>
                      <option value="less_than_8">&lt;8g</option>
                      <option value="between_8_and_14">8-14g</option>
                      <option value="between_14_and_18">14-18g</option>
                      <option value="greater_equal_18">&gt;18g</option>
                    </select>
                    <div id="weightError" class="error-message">Please select a weight</div>
                  </div>

                  <h4 class="card-title">Set amount of order</h4>
                  <div class="form-group">
                    <div class="form-check form-check-flat form-check-primary">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="maleCheckbox" onchange="toggleInput('maleQuantity', this.checked)"> Male
                      </label>
                    </div>
                    <input type="number" class="form-control form-control-lg" id="maleQuantity" name="male_quantity" placeholder="Quantity" min="1" value="0" disabled>
                    <div id="maleStock">Stock: -</div>
                  </div>

                  <div class="form-group">
                    <div class="form-check form-check-flat form-check-primary">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="femaleCheckbox" onchange="toggleInput('femaleQuantity', this.checked)"> Female
                      </label>
                    </div>
                    <input type="number" class="form-control form-control-lg" id="femaleQuantity" name="female_quantity" placeholder="Quantity" min="1" value="0" disabled>
                    <div id="femaleStock">Stock: -</div>
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
      </div>
      </div>

      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024, Biofarma. STAS-RG. All rights reserved.</span>
        </div>
      </footer>
    </div>
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- Invoice Modal -->
  <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="invoiceModalLabel">Invoice</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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

  <!-- plugins:js -->
  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
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
      
    function fetchStockCount() {
    var selectedWeight = document.getElementById('weightSelect').value;

    fetch(`/detailmencit/updateStockCounts?weight=${selectedWeight}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('maleStock').textContent = `Stock: ${data.maleStock}`;
            document.getElementById('femaleStock').textContent = `Stock: ${data.femaleStock}`;
            
            // Simpan data stok dalam variabel global
            window.maleStockAvailable = data.maleStock;
            window.femaleStockAvailable = data.femaleStock;
        })
        .catch(error => {
            console.error('Error fetching stock counts:', error);
        }); 
    }

    function toggleInput(inputId, isChecked) {
        var input = document.getElementById(inputId);
        input.disabled = !isChecked;
        if (isChecked) {
            input.value = '';
            input.focus();
        } else {
            input.value = 0;
        }
        calculateTotal();
    }

    function validateQuantity(inputId, maxStock) {
        var input = document.getElementById(inputId);
        var value = parseInt(input.value) || 0;
        
        if (value < 0 || value > maxStock) {
            input.value = 0; // Kembalikan ke 0 jika lebih dari stok atau negatif
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: `Jumlah tidak valid! Jumlah harus antara 0 dan ${maxStock}`,
                customClass: {
                            popup: 'custom-swal-popup',
                            icon: 'custom-swal-icon'
                        }
            });
        }
    }

    function calculateTotal() {
        var maleQuantity = parseInt(document.getElementById('maleQuantity').value) || 0;
        var femaleQuantity = parseInt(document.getElementById('femaleQuantity').value) || 0;
        
        // Validasi input male berdasarkan stok
        validateQuantity('maleQuantity', window.maleStockAvailable || 0);
        
        // Validasi input female berdasarkan stok
        validateQuantity('femaleQuantity', window.femaleStockAvailable || 0);
        
        var totalQuantity = maleQuantity + femaleQuantity;
        document.getElementById('totalQuantity').value = totalQuantity;
    }

    document.getElementById('maleQuantity').addEventListener('input', function () {
        calculateTotal();
    });

    document.getElementById('femaleQuantity').addEventListener('input', function () {
        calculateTotal();
    });

    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("submitOrderButton").addEventListener("click", function (e) {
            e.preventDefault(); // Prevent form from submitting
            console.log("Submit button clicked");

            // Fetch form data
            const orderData = {
                fullname: document.querySelector("input[name='fullname']").value,
                phone_number: document.querySelector("input[name='phone_number']").value,
                email: document.querySelector("input[name='email']").value,
                item_name: document.querySelector("input[name='item_name']").value,
                agency_name: document.querySelector("input[name='agency_name']").value,
                operator_name: document.querySelector("input[name='operator_name']").value,
                weight: document.querySelector("select[name='weight']").value, // Now a string
                male_quantity: document.querySelector("input[name='male_quantity']").value || 0,
                female_quantity: document.querySelector("input[name='female_quantity']").value || 0,
                total_price: calculateTotalPrice()
            };

            // Show invoice modal with fetched data
            showInvoiceModal(orderData);
        });

    function calculateTotalPrice() {
        const maleQuantity = parseInt(document.querySelector("input[name='male_quantity']").value) || 0;
        const femaleQuantity = parseInt(document.querySelector("input[name='female_quantity']").value) || 0;
        const malePrice = 4000; 
        const femalePrice = 5000; 
        return (maleQuantity * malePrice) + (femaleQuantity * femalePrice);
    }

    function showInvoiceModal(order) {
      const weightMap = {
        'less_than_8': '<8g',
        'between_8_and_14': '8-14g',
        'between_14_and_18': '14-18g',
        'greater_equal_18': '>18g'
        };
        
        const invoiceContent = `
          <h5 class="card-title">Order Details</h5>
          <p><strong>Fullname:</strong> ${order.fullname}</p>
          <p><strong>Phone Number:</strong> ${order.phone_number}</p>
          <p><strong>Email:</strong> ${order.email}</p>
          <p><strong>Item Name:</strong> ${order.item_name}</p>
          <p><strong>Agency Name:</strong> ${order.agency_name}</p>
          <p><strong>Operator Name:</strong> ${order.operator_name}</p>
          <p><strong>Weight:</strong> ${weightMap[order.weight] || order.weight}</p>
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

    document.getElementById("payButton").addEventListener("click", function () {
    // Tambahkan konfirmasi sebelum pembayaran
    const confirmation = confirm("Apakah kamu yakin ingin melakukan pembayaran?");
    
    if (confirmation) {
      window.location.reload();
        // Jika konfirmasi diterima, lanjutkan dengan proses pembayaran
        const orderData = {
            _token: '{{ csrf_token() }}',
            fullname: document.querySelector("input[name='fullname']").value,
            phone_number: document.querySelector("input[name='phone_number']").value,
            email: document.querySelector("input[name='email']").value,
            item_name: document.querySelector("input[name='item_name']").value,
            agency_name: document.querySelector("input[name='agency_name']").value,
            operator_name: document.querySelector("input[name='operator_name']").value,
            weight: document.querySelector("select[name='weight']").value,
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
                console.log("Order sukses", data);
                alert("Order has been paid successfully!");

                // Update stok secara otomatis di tampilan setelah pembayaran berhasil
                updateStockCounts();

                // Nonaktifkan tombol "Bayar"
                document.getElementById("payButton").disabled = true;
                document.getElementById("invoiceContent").innerHTML += "<p><strong>Status:</strong> Paid</p>";

                // Tutup modal setelah sukses
                var invoiceModal = bootstrap.Modal.getInstance(document.getElementById('invoiceModal'));
                invoiceModal.hide();

                // Reset form setelah pembayaran sukses
                document.getElementById("orderForm").reset();

                // Reset tampilan stok setelah pembayaran
                document.getElementById('maleStock').textContent = "Stock: -";
                document.getElementById('femaleStock').textContent = "Stock: -";
                document.getElementById('totalQuantity').value = 0;

                // Refresh halaman setelah form di-reset
                window.location.reload(); // Ini akan memuat ulang halaman
            } else {
                alert("Failed to process payment!");
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        // Jika konfirmasi ditolak, tidak melakukan apa-apa
        console.log("Pembayaran dibatalkan oleh pengguna.");
    }
});



// Function to update stock counts (calls the backend to get updated stock)
function updateStockCounts() {
    fetch("{{ route('detailmencit.updateStockCounts') }}")
        .then(response => response.json())
        .then(data => {
            // Update Male Stock Counts
            let maleSickElement = document.querySelector('.male-sick-count');
            if (maleSickElement) {
                maleSickElement.textContent = data.maleSickCount;
            }

            let maleHealthyLessThan8 = document.querySelector('.male-healthy-less-than-8');
            if (maleHealthyLessThan8) {
                maleHealthyLessThan8.textContent = data.maleHealthyCounts.less_than_8;
            }

            let maleHealthyBetween8And14 = document.querySelector('.male-healthy-between-8-and-14');
            if (maleHealthyBetween8And14) {
                maleHealthyBetween8And14.textContent = data.maleHealthyCounts.between_8_and_14;
            }

            let maleHealthyBetween14And18 = document.querySelector('.male-healthy-between-14-and-18');
            if (maleHealthyBetween14And18) {
                maleHealthyBetween14And18.textContent = data.maleHealthyCounts.between_14_and_18;
            }

            let maleHealthyGreater18 = document.querySelector('.male-healthy-greater-18');
            if (maleHealthyGreater18) {
                maleHealthyGreater18.textContent = data.maleHealthyCounts.greater_equal_18;
            }

            // Update Female Stock Counts
            let femaleSickElement = document.querySelector('.female-sick-count');
            if (femaleSickElement) {
                femaleSickElement.textContent = data.femaleSickCount;
            }

            let femaleHealthyLessThan8 = document.querySelector('.female-healthy-less-than-8');
            if (femaleHealthyLessThan8) {
                femaleHealthyLessThan8.textContent = data.femaleHealthyCounts.less_than_8;
            }

            let femaleHealthyBetween8And14 = document.querySelector('.female-healthy-between-8-and-14');
            if (femaleHealthyBetween8And14) {
                femaleHealthyBetween8And14.textContent = data.femaleHealthyCounts.between_8_and_14;
            }

            let femaleHealthyBetween14And18 = document.querySelector('.female-healthy-between-14-and-18');
            if (femaleHealthyBetween14And18) {
                femaleHealthyBetween14And18.textContent = data.femaleHealthyCounts.between_14_and_18;
            }

            let femaleHealthyGreater18 = document.querySelector('.female-healthy-greater-18');
            if (femaleHealthyGreater18) {
                femaleHealthyGreater18.textContent = data.femaleHealthyCounts.greater_equal_18;
            }

            // Reload DataTable if available
            // $('.yajra-datatable').DataTable().ajax.reload();
        })
        .catch(error => {
            console.error('Error fetching stock counts:', error);
        });
}
});

</script>
</body>

</html>

       
