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
    @include('partials.navbarAdmin')
    <!-- Navbar ends -->

    <!-- Sidebar -->
    @include('partials.sidebarAdmin')
    {{-- sidebar ends --}}

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
                      <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Fullname" maxlength="40" required>
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
                      <option value="category1">&lt;10g</option>
                      <option value="category2">10-22g</option>
                      <option value="category3">&gt;22g</option>
                      {{-- <option value="category4">&gt;22g</option> --}}
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
        @include('partials.footer')
      </div>
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
  
  @include('partials.pusher')
  <script>
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
        'category1': '<10g',
        'category2': '10-22g',
        'category3': '>22g'
        // 'category4': '>18g'
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
                maleHealthyLessThan8.textContent = data.maleHealthyCounts.category1;
            }

            let maleHealthyBetween8And14 = document.querySelector('.male-healthy-between-8-and-14');
            if (maleHealthyBetween8And14) {
                maleHealthyBetween8And14.textContent = data.maleHealthyCounts.category2;
            }

            // let maleHealthyBetween14And18 = document.querySelector('.male-healthy-between-14-and-18');
            // if (maleHealthyBetween14And18) {
            //     maleHealthyBetween14And18.textContent = data.maleHealthyCounts.category3;
            // }

            let maleHealthyGreater18 = document.querySelector('.male-healthy-greater-18');
            if (maleHealthyGreater18) {
                maleHealthyGreater18.textContent = data.maleHealthyCounts.category3;
            }

            // Update Female Stock Counts
            let femaleSickElement = document.querySelector('.female-sick-count');
            if (femaleSickElement) {
                femaleSickElement.textContent = data.femaleSickCount;
            }

            let femaleHealthyLessThan8 = document.querySelector('.female-healthy-less-than-8');
            if (femaleHealthyLessThan8) {
                femaleHealthyLessThan8.textContent = data.femaleHealthyCounts.category1;
            }

            let femaleHealthyBetween8And14 = document.querySelector('.female-healthy-between-8-and-14');
            if (femaleHealthyBetween8And14) {
                femaleHealthyBetween8And14.textContent = data.femaleHealthyCounts.category2;
            }

            // let femaleHealthyBetween14And18 = document.querySelector('.female-healthy-between-14-and-18');
            // if (femaleHealthyBetween14And18) {
            //     femaleHealthyBetween14And18.textContent = data.femaleHealthyCounts.category3;
            // }

            let femaleHealthyGreater18 = document.querySelector('.female-healthy-greater-18');
            if (femaleHealthyGreater18) {
                femaleHealthyGreater18.textContent = data.femaleHealthyCounts.category3;
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

       
