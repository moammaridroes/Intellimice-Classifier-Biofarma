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
        <!-- navbar -->
        @include('partials.navbarAdmin')

        <!-- sidebar -->
        @include('partials.sidebarAdmin')

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
                                                        <span class="badge badge-danger bg-{{ $order->status == 'approved' ? 'success' : ($order->status == 'rejected' ? 'danger' : 'warning') }}">
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
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging-compat.js"></script>

    <script>
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
    if (!data.order) {
        console.log('Tidak ada data order yang diterima.');
        return; // Hentikan jika tidak ada data order
    }

    // Buat container notifikasi
    const notificationContainer = document.createElement('div');
    notificationContainer.classList.add('notification-container');
    notificationContainer.textContent = `New orders have been received`;
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

    // Tambahkan baris baru di tabel jika data order tersedia
    let tbody = document.querySelector("table.table tbody");
    if (tbody) {
        let newRow = `
            <tr>
                <td>${data.order.fullname}</td>
                <td>${data.order.item_name}</td>
                <td>${data.order.agency_name}</td>
                <td>${new Date(data.order.pick_up_date).toLocaleDateString('id-ID', { year: 'numeric', month: '2-digit', day: '2-digit' }).replace(/\//g, '-')}</td>
                <td>Rp ${parseInt(data.order.total_price).toLocaleString('id-ID')}</td>
                <td><span class="badge badge-warning">Pending</span></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                         <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#orderDetailsModal"
                            data-order='${JSON.stringify(data.order)}'>Details</button>
                        <form action="/admin/customer-orders/${data.order.id}/approve" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="/admin/customer-orders/${data.order.id}/reject" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                        
                        </form>
                    </div>
                </td>
            </tr>
        `;
        tbody.insertAdjacentHTML("afterbegin", newRow);
    }

        // Perbarui jumlah notifikasi yang belum dibaca
        const badge = document.getElementById('notificationBadge');
        if (badge) {
            // Ambil nilai badge saat ini dan ubah ke angka (0 jika kosong)
            let currentCount = parseInt(badge.textContent) || 0;
                
            // Tambahkan 1 ke nilai saat ini
            badge.textContent = currentCount + 1;
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
