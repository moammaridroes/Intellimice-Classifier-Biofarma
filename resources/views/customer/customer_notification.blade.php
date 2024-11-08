<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Your Notifications</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/logobiofarmakecil.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- Custom CSS for Notifications -->
    <style>
        .language-icon {
            font-size: 1.5rem; /* Atur ukuran ikon */
            margin-right: 7px; /* Spasi antara ikon dan teks */
            color: #000000; /* Warna ikon */
        }



        .notification-card {
            padding: 8px 15px; 
            margin-bottom: 8px; 
            border-radius: 4px; 
            background-color: #f8f9fa;
            border-left: 4px solid; 
            display: flex; 
            align-items: center;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1); 
        }

        .notification-card h5 {
            margin: 0 0 4px 0;
            font-size: 1rem;
        }

        .notification-card p {
            margin: 0; 
            font-size: 0.9rem;
        }

        .status-approved {
            border-color: #28a745; 
            background-color: #d4edda;
            color: #155724;
        }

        .status-rejected {
          background-color: #f8d7da;
          color: #721c24;
          border-left: 4px solid #dc3545;        }

        .status-pending {
          background-color: #fff3cd; 
          color: #856404;
          border-left: 4px solid #ffc107; 
        }

        .notification-date-header {
            font-weight: bold;
            font-size: 1rem; 
            margin: 15px 0 10px 0; 
            color: #343a40;
        }

        .main-panel {
            padding: 20px; /* Kurangi padding pada panel utama */
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:_navbar.blade.php -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{ url('/customer/home') }}">
                    <img src="{{ asset('images/Logo_Bio_Farma.png') }}" style="width: 65%; height: 65%;" class="mr-2"
                        alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('/customer/home') }}">
                    <img src="{{ asset('images/logobiofarmakecil.png') }}" alt="logo" />
                </a>
            </div>

            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>

                <div class="d-flex align-items-center ml-auto">
                    <div class="nav-item dropdown mr-4">
                        <a class="nav-link p-0" href="#" data-toggle="dropdown" id="languageDropdown">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="black" d="m12 22l-1-3H4q-.825 0-1.412-.587T2 17V4q0-.825.588-1.412T4 2h6l.875 3H20q.875 0 1.438.563T22 7v13q0 .825-.562 1.413T20 22zm-4.85-7.4q1.725 0 2.838-1.112T11.1 10.6q0-.2-.012-.362t-.063-.338h-3.95v1.55H9.3q-.2.7-.763 1.088t-1.362.387q-.975 0-1.675-.7T4.8 10.5t.7-1.725t1.675-.7q.45 0 .85.163t.725.487L9.975 7.55Q9.45 7 8.712 6.7T7.15 6.4q-1.675 0-2.863 1.188T3.1 10.5t1.188 2.913T7.15 14.6m6.7.5l.55-.525q-.35-.425-.637-.825t-.563-.85zm1.25-1.275q.7-.825 1.063-1.575t.487-1.175h-3.975l.3 1.05h1q.2.375.475.813t.65.887M13 21h7q.45 0 .725-.288T21 20V7q0-.45-.275-.725T20 6h-8.825l1.175 4.05h1.975V9h1.025v1.05H19v1.025h-1.275q-.25.95-.75 1.85T15.8 14.6l2.725 2.675L17.8 18l-2.7-2.7l-.9.925L15 19z"/></svg>
                                {{-- <span style="color: black;">@lang('messages.languages')</span> --}}
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="languageDropdown">
                            <a class="dropdown-item" href="{{ url('locale/en') }}">English</a>
                            <a class="dropdown-item" href="{{ url('locale/id') }}">Bahasa Indonesia</a>
                        </div>
                    </div>
        
                    <div class="nav-item dropdown">
                        <span class="text-black font-weight-bold mr-2">
                            {{ Auth::user()->name }}
                        </span>
        
                        <a class="nav-link p-0" href="#" data-toggle="dropdown" id="profileDropdown">
                            <div class="d-flex justify-content-center">
                                <svg class="fill-current text-black" width="20" height="20"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </a>
        
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            {{-- <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                {{ __('Profile') }}
                            </a> --}}
        
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
            </div>
        </nav>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:_settings-panel.blade.php -->
            <div id="settings-trigger"><i class="ti-settings"></i></div>
            <!-- partial -->
            <!-- partial:_sidebar.blade.php -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
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
                            {{-- @if($unreadNotificationsCount > 0)
                                <span class="badge badge-danger">{{ $unreadNotificationsCount }}</span>
                            @endif --}}
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
                                <li class="nav-item"><a class="nav-link" href="{{ url('customer/orderform') }}">Order
                                        Forms</a></li>
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ url('customer/history') }}">Order
                                        History</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <!-- Main Content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div>
                                <h4 class="card-title">@lang('messages.notifications') </h4>
                                <div class="row">
                                    @php
                                    // Urutkan orders berdasarkan created_at secara descending dan kelompokkan berdasarkan tanggal
                                    $groupedOrders = $orders->sortByDesc('created_at')->groupBy(function($order) {
                                    return \Carbon\Carbon::parse($order->created_at)->format('d-m-Y');
                                    });
                                    @endphp

                                    @foreach($groupedOrders as $date => $dailyOrders)
                                    <div class="col-12">
                                        <div class="notification-date-header">{{ $date }}</div>
                                    </div>
                                    @foreach($dailyOrders as $order)
                                    <div class="col-12">
                                        <div class="notification-card status-{{ $order->status }}">
                                            <div class="notification-info">
                                                <h5>{{ $order->item_name }}</h5>
                                                <p><strong>@lang('messages.status') :</strong> {{ ucfirst($order->status) }}</p>                                                <p>
                                                    @if($order->status == 'approved')
                                                        @lang('messages.approved_message')  <strong>{{ \Carbon\Carbon::parse($order->pick_up_date)->format('d-m-Y') }}</strong>
                                                    @elseif($order->status == 'rejected')
                                                        @lang('messages.rejected_message') 
                                                    @else
                                                        @lang('messages.pending_message') 
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024,
                            Biofarma. STAS-RG. All rights reserved.</span>
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
    {{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>
            // Inisialisasi Pusher
            const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
                cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
                encrypted: true,
            });

            // Subscribe ke channel privat khusus customer
            const userId = {{ auth()->id() }};
            const channel = pusher.subscribe(`private-order.${userId}`);

            // Style untuk notifikasi
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

            // Bind event OrderStatusUpdated untuk menerima notifikasi real-time
            channel.bind('OrderStatusUpdated', function(data) {
                // Buat container notifikasi
                const notificationContainer = document.createElement('div');
                notificationContainer.classList.add('notification-container');
                notificationContainer.innerHTML = `
                    Pesanan untuk <strong>${data.item_name}</strong> telah ${data.status}.
                    <br><small>Diperbarui pada ${data.updated_at}</small>
                `;
                document.body.appendChild(notificationContainer);

                // Animasi muncul notifikasi
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

                // Update badge notifikasi pada sidebar jika ada
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
        </script>     --}}
</body>

</html>
