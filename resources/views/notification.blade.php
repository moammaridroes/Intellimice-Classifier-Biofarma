<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Notifications</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/logobiofarmakecil.png') }}" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
</head>
<style> 
    .modal-body p {
    word-wrap: break-word;
    white-space: pre-wrap; /* Preserves the line breaks and spaces */
}
</style>

<body>
    <div class="container-scroller">
        <!-- partial:_navbar.blade.php -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{ url('/') }}">
                    <img src="{{ asset('images/Logo_Bio_Farma.png') }}" style="width: 65%; height: 65%;" class="mr-2"
                        alt="logo" />
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
                    <!-- Username Display -->
                    <span class="text-black font-weight-bold">
                        {{ Auth::user()->name }}
                    </span>

                    <!-- Trigger Button with SVG Icon -->
                    <a class="nav-link p-0" href="#" data-toggle="dropdown" id="profileDropdown">
                        <div class="ms-1 d-flex justify-content-center">
                            <!-- Custom Black SVG Icon -->
                            <svg class="fill-current text-black" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 011.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                        <!-- Logout Form -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>
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
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                </div>
            </div>
            <!-- partial:_sidebar.blade.php -->
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
                        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                            aria-controls="form-elements">
                            <i class="icon-columns menu-icon"></i>
                            <span class="menu-title">Order</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ url('orderform') }}">Order Forms</a>
                                </li>
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ url('orderhistory') }}">Offline
                                        History</a></li>
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ url('online-history') }}">Online
                                        History</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false"
                            aria-controls="tables">
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
                </ul>
            </nav>
            <!-- Main Content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Order Notifications</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Item Name</th>
                                                    <th>Agency</th>
                                                    <th>Pick Up Date</th>
                                                    <th>total Price</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($orders as $order)
                                                <tr>
                                                    <td>{{ $order->fullname }}</td>
                                                    <td>{{ $order->item_name }}</td>
                                                    <td>{{ $order->agency_name }}</td>
                                                    <td>{{ ($order->pick_up_date)->format('d-m-Y') }}</td>
                                                    <td>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                                    <td>
                                                        <span class="badge rounded-pill bg-{{ $order->status == 'approved' ? 'success' : ($order->status == 'rejected' ? 'danger' : 'warning') }}">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#orderDetailsModal"
                                                            data-order="{{ json_encode($order) }}">Details</button>
                                                        <form action="{{ route('admin.customer-orders.approve', $order->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-success btn-sm">Approve</button>
                                                        </form>
                                                        <form action="{{ route('admin.customer-orders.reject', $order->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Reject</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="7">No orders available</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->

                <!-- Order Details Modal -->
                <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Details will be inserted here dynamically -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Order Details Modal ends -->

                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span
                            class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright
                            © 2024, Biofarma. STAS-RG. All rights reserved.</span>
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
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- <script src="https://js.pusher.com/7.2/pusher.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.2.0/pusher.min.js"></script> --}}
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.1/dist/echo.iife.js"></script> --}}

    <script>
    // Kode inisialisasi Pusher yang ada
    const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
    cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
    encrypted: true,
    
    // forceTLS: true, // Memaksa penggunaan 
    // wsHost: 'ws-ap1.pusher.com', // Host WebSocket yang benar untuk cluster ap1
    // // wsPort: 6001, // Port default WebSocket untuk Laravel Echo Server
    // wssPort: 443, // Port aman WebSocket
    // enabledTransports: ['ws', 'wss'], // Membatasi transport ke WebSocket   
    // disableStats: true // Mengurangi masalah CORS dengan menonaktifkan statistik
});


    // Subscribe ke channel
    const channel = pusher.subscribe('orders');

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
        
        // Secara opsional, perbarui DOM untuk mencerminkan pesanan baru tanpa memuat ulang halaman
        let tbody = document.querySelector("table.table tbody");
        let newRow = `
            <tr>
                <td>${data.order.fullname}</td>
                <td>${data.order.item_name}</td>
                <td>${data.order.agency_name}</td>
                <td>${new Date(data.order.pick_up_date).toLocaleDateString('id-ID', { year: 'numeric', month: '2-digit', day: '2-digit' }).replace(/\//g, '-')}</td>
                <td>Rp ${parseInt(data.order.total_price).toLocaleString('id-ID')}</td>
                <td><span class="badge badge-warning">Pending</span></td>
                <td>
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#orderDetailsModal"
                            data-order='${JSON.stringify(data.order)}'>Details</button>
                    <form action="{{ route('admin.customer-orders.approve', '') }}/${data.order.id}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                    </form>
                    <form action="{{ route('admin.customer-orders.reject', '') }}/${data.order.id}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                    </form>
                </td>
            </tr>
        `;
        tbody.insertAdjacentHTML("afterbegin", newRow);

        // Perbarui jumlah notifikasi yang belum dibaca
        let badge = document.querySelector('.nav-link .badge');
        if (badge) {
            let currentCount = parseInt(badge.textContent);
            badge.textContent = currentCount + 1; // Tambah jumlah notifikasi
        } else {
            // Jika badge tidak ada, buat badge baru
            badge = document.createElement('span');
            badge.classList.add('badge', 'badge-danger');
            badge.textContent = 1;
            document.querySelector('.nav-link').appendChild(badge);
        }
    });
   
        // Menampilkan detail order di modal
        const orderDetailsModal = document.getElementById('orderDetailsModal');
        orderDetailsModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const order = JSON.parse(button.getAttribute('data-order')); // Data order dari button
    
            // Memastikan bahwa data order tersedia dan valid
            if (order) {
                const modalBody = orderDetailsModal.querySelector('.modal-body');
                modalBody.innerHTML = `
                    <p><strong>Customer Name:</strong> ${order.fullname}</p>
                    <p><strong>Phone Number:</strong> ${order.phone_number}</p>
                    <p><strong>Email:</strong> ${order.email}</p>
                    <p><strong>Item Name:</strong> ${order.item_name}</p>
                    <p><strong>Agency Name:</strong> ${order.agency_name}</p>
                    <p><strong>Pick Up Date:</strong> ${new Date(order.pick_up_date).toLocaleDateString('id-ID')}</p>
                    <p><strong>Weight:</strong> ${order.weight}</p>
                    <p><strong>Male Quantity:</strong> ${order.male_quantity}</p>
                    <p><strong>Female Quantity:</strong> ${order.female_quantity}</p>
                    <p><strong>Total Price:</strong> Rp ${new Intl.NumberFormat('id-ID').format(order.total_price)}</p>
                    <p><strong>Status:</strong> ${order.status}</p>
                    <p><strong>Notes:</strong> ${order.notes || '-'}</p>`;
            } else {
                console.error('Tidak ada data order yang ditemukan.');
            }
        });
    </script>
    </body>
</html>
